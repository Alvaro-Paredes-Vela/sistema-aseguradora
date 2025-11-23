<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Poliza;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class AutomotrizController extends Controller
{
    // === PASO 1: REGISTRAR VEHÍCULO BÁSICO ===
    public function registrarVehiculo()
    {
        return view('cliente.automotriz.registrar_vehiculo');
    }

    public function guardarPaso1(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|regex:/^[A-Z0-9-]+$/|max:10',
            'valor_comercial' => 'required|numeric|min:10000|max:1000000',
            'uso_vehiculo' => 'required|in:particular,publico',
            'region' => 'required|in:santa_cruz,la_paz,cochabamba,oruro,potosi,beni,pando,chuquisaca,tarija',
            'seguro' => 'required|in:total,terceros', // ← Este es "total" o "terceros"

            // PROPIETARIO
            'nombre' => 'required|string|max:100',
            'paterno' => 'required|string|max:100',
            'CI' => 'required|string|max:20',
            'correo' => 'required|email|max:100',
            'telefono' => 'required|string|max:20',
        ]);

        // CREAR CLIENTE
        $cliente = \App\Models\Cliente::create(
            [
                'CI' => $request->CI,
                'nombre' => $request->nombre,
                'paterno' => $request->paterno,
                'materno' => $request->materno ?? '',
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'login' => null,
                'password' => null,
                'direccion' => null,
                'estado' => 1,
                'foto' => null,
            ]
        );

        Session::put('cotizacion_automotriz', [
            'placa' => strtoupper($request->placa),
            'valor_comercial' => $request->valor_comercial,
            'uso_vehiculo' => $request->uso_vehiculo,
            'region' => $request->region,
            'tipo_cobertura' => $request->seguro, // ← total o terceros
            'cliente_id' => $cliente->id_cliente,
            'franquicia_tipo' => 'ninguna', // valor por defecto
            'prima' => 0, // se calculará en el paso 2
        ]);

        return redirect()->route('automotriz.cotizar-paso2');
    }
    // === PASO 2: COTIZAR PRIMA ===
    public function cotizarPaso2()
    {
        $datos = Session::get('cotizacion_automotriz');
        if (!$datos) return redirect()->route('automotriz.registrar-vehiculo');

        $prima = $this->calcularPrima($datos, $datos['franquicia_tipo'] ?? '500');
        $datos['prima'] = $prima;
        Session::put('cotizacion_automotriz', $datos);

        return view('cliente.automotriz.cotizar_paso2', compact('datos', 'prima'));
    }

    // NUEVO: Recalcular prima al cambiar franquicia
    public function recalcularPrima(Request $request)
    {
        $request->validate([
            'franquicia_tipo' => 'required|in:ninguna,300,500,800,1200,porcentaje_5',
        ]);

        $cotizacion = Session::get('cotizacion_automotriz');

        // CALCULAR PRIMA BASE (SIN DESCUENTO)
        $primaBase = $cotizacion['valor_comercial'] * ($cotizacion['tipo_cobertura'] === 'total' ? 0.25 : 0.15);

        $descuentos = [
            'ninguna' => 0.00,
            '300' => 0.10,
            '500' => 0.18,
            '800' => 0.25,
            '1200'         => 0.30,
            'porcentaje_5' => 0.20,
        ];

        $descuento = $descuentos[$request->franquicia_tipo] ?? 0.18;
        $primaNueva = round($primaBase * (1 - $descuento));

        $cotizacion['franquicia_tipo'] = $request->franquicia_tipo;
        $cotizacion['prima'] = $primaNueva;
        Session::put('cotizacion_automotriz', $cotizacion);

        return redirect()->back();
    }

    private function calcularPrima($datos, $franquiciaTipo = '500')
    {
        $valor = $datos['valor_comercial'];
        $tipo  = $datos['tipo_cobertura'];

        $primaBase = $valor * ($tipo === 'total' ? 0.25 : 0.15);

        $descuentos = [
            'ninguna'      => 0.00,
            '300'          => 0.10,
            '500'          => 0.18,
            '800'          => 0.25,
            '1200'         => 0.30,
            'porcentaje_5' => 0.20,
        ];

        $descuento = $descuentos[$franquiciaTipo] ?? 0.18;
        $primaFinal = round($primaBase * (1 - $descuento));

        $datos['prima'] = $primaFinal;
        $datos['franquicia_tipo'] = $franquiciaTipo;

        return $datos;
    }

    public function confirmarCotizacion(Request $request)
    {
        $cotizacion = Session::get('cotizacion_automotriz');
        if (!$cotizacion || !$cotizacion['prima']) {
            return redirect()->route('automotriz.registrar-vehiculo');
        }

        return redirect()->route('automotriz.completar-registro');
    }

    // === PASO 3: COMPLETAR REGISTRO (futuro) ===
    public function completarRegistro()
    {
        $cotizacion = session('cotizacion_automotriz');
        if (!$cotizacion) {
            return redirect()->route('automotriz.registrar-vehiculo')
                ->with('error', 'Debes completar los pasos anteriores.');
        }

        // OBTENER TODOS LOS MODELOS CON SU MARCA
        $modelos = \App\Models\Modelo::with('marca')->orderBy('id_marca')->get();

        return view('cliente.automotriz.completar_registro', compact('cotizacion', 'modelos'));
    }

    // === OTRAS VISTAS ===
    public function guiaSiniestro()
    {
        return view('cliente.automotriz.guia_siniestro');
    }
    public function normativas()
    {
        return view('cliente.automotriz.normativas');
    }

    public function verificarVigencia(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:10'
        ]);

        $placa = strtoupper($request->placa);

        // 1. BUSCAR SI TIENE SEGURO AUTOMOTRIZ VIGENTE (cualquier plan que diga "Automotriz")
        $polizaAutomotriz = DB::table('polizas')
            ->join('seguros', 'polizas.id_seguro', '=', 'seguros.id_seguro')
            ->join('vehiculos', 'polizas.id_vehiculo', '=', 'vehiculos.id_vehiculo')
            ->where('vehiculos.placa', $placa)
            ->where('seguros.nombre', 'like', '%Automotriz')   // ← Detecta Total y Terceros
            ->where('polizas.estado', 'vigente')
            ->whereDate('polizas.fecha_vencimiento', '>=', now())
            ->select('polizas.*', 'seguros.nombre as tipo_seguro')
            ->first();

        if ($polizaAutomotriz) {
            return redirect()->back()->with([
                'success' => "¡Tu Seguro Automotriz está vigente hasta " .
                    Carbon::parse($polizaAutomotriz->fecha_vencimiento)->format('d/m/Y') . "!",
                'poliza_id' => $polizaAutomotriz->id_poliza
            ]);
        }

        // 2. VERIFICAR SI SOLO TIENE SOAT
        $tieneSoat = DB::table('polizas')
            ->join('seguros', 'polizas.id_seguro', '=', 'seguros.id_seguro')
            ->join('vehiculos', 'polizas.id_vehiculo', '=', 'vehiculos.id_vehiculo')
            ->where('vehiculos.placa', $placa)
            ->where('seguros.nombre', 'SOAT')   // ← Exacto, porque solo hay uno llamado así
            ->where('polizas.estado', 'vigente')
            ->whereDate('polizas.fecha_vencimiento', '>=', now())
            ->exists();

        if ($tieneSoat) {
            return redirect()->back()->with(
                'info',
                "Tu vehículo tiene SOAT vigente, pero NO tienes Seguro Automotriz contratado con nosotros. " .
                    "¡Cotiza ahora un plan Todo Riesgo o a Terceros y viaja 100% protegido!"
            );
        }

        // 3. NO TIENE NADA
        return redirect()->back()->with(
            'warning',
            "No encontramos ningún Seguro Automotriz vigente para la placa {$placa}. " .
                "¡Cotiza ahora y obtén la mejor protección!"
        );
    }

    public function guardarCompleto(Request $request)
    {
        $cotizacion = session('cotizacion_automotriz');
        if (!$cotizacion) {
            return redirect()->route('automotriz.registrar-vehiculo')
                ->with('error', 'Debes completar los pasos anteriores.');
        }

        $clienteId = $cotizacion['cliente_id'];

        $request->validate([
            'anio_fabricacion' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:50',
            'nro_chasis' => 'required|string|max:50',
            'nro_motor' => 'required|string|max:50',
            'cilindrada' => 'nullable|integer',
            'RUAT' => 'nullable|string|max:70',
            'tipo_combustible' => 'required|string|max:50',
            'kilometraje' => 'nullable|integer',
            'id_modelo' => 'required|exists:modelos,id_modelo',
        ]);

        return DB::transaction(function () use ($request, $cotizacion, $clienteId) {
            // 1. CREAR VEHÍCULO
            $vehiculo = Vehiculo::create([
                'placa' => $cotizacion['placa'],
                'anio_fabricacion' => $request->anio_fabricacion,
                'color' => $request->color,
                'nro_chasis' => $request->nro_chasis,
                'nro_motor' => $request->nro_motor,
                'cilindrada' => $request->cilindrada,
                'RUAT' => $request->RUAT,
                'tipo_vehiculo' => 'automovil',
                'uso_vehiculo' => $cotizacion['uso_vehiculo'],
                'region' => $cotizacion['region'],
                'tipo_combustible' => $request->tipo_combustible,
                'kilometraje' => $request->kilometraje,
                'valor_comercial' => $cotizacion['valor_comercial'],
                'estado' => 'activo',
                'id_cliente' => $clienteId,
                'id_modelo' => $request->id_modelo,
            ]);

            // 2. TIPO DE SEGURO AUTOMOTRIZ
            $idTipoAutomotriz = DB::table('tipos_seguro')
                ->where('nombre', 'like', '%automotriz%')
                ->value('id_tipo');

            if (!$idTipoAutomotriz) {
                throw new \Exception('Tipo de seguro Automotriz no encontrado.');
            }

            // 3. CREAR SEGURO
            $nombreSeguro = $cotizacion['tipo_cobertura'] === 'total'
                ? 'Seguro Total Automotriz'
                : 'Seguro a Terceros Automotriz';

            $primaNumero = 0;

            if (isset($cotizacion['prima'])) {
                $valor = $cotizacion['prima'];
                if (is_numeric($valor)) {
                    $primaNumero = (int) round($valor);
                } elseif (is_array($valor) && isset($valor['monto'])) {
                    $primaNumero = (int) round($valor['monto']);
                } elseif (is_object($valor) && isset($valor->monto)) {
                    $primaNumero = (int) round($valor->monto);
                }
            }

            // Si por algún motivo sigue en 0, recalculamos rápido para no fallar
            if ($primaNumero <= 0) {
                $tasa = $cotizacion['tipo_cobertura'] === 'total' ? 0.25 : 0.15;
                $primaBase = $cotizacion['valor_comercial'] * $tasa;

                $descuentos = [
                    'ninguna' => 0.00,
                    '300' => 0.10,
                    '500' => 0.18,
                    '800' => 0.25,
                    '1200' => 0.30,
                    'porcentaje_5' => 0.20,
                ];
                $descuento = $descuentos[$cotizacion['franquicia_tipo'] ?? '500'] ?? 0.18;

                $primaNumero = (int) round($primaBase * (1 - $descuento));
            }

            $seguro = \App\Models\Seguro::create([
                'nombre' => $nombreSeguro,
                'id_tipo' => $idTipoAutomotriz,
                'id_categoria' => 2,
                //vigenicia 1 año dato esta en date
                'vigencia' => 12,
                'precio' => $primaNumero,
            ]);

            $this->registrarRequisitosParaSeguro($seguro, $cotizacion['tipo_cobertura']);

            // 4. CREAR COTIZACIÓN
            $cotizacionDB = \App\Models\Cotizacion::create([
                'precio_total' => $primaNumero,
                'fecha' => now(),
                'id_vehiculo' => $vehiculo->id_vehiculo,
                'id_seguro' => $seguro->id_seguro,
            ]);

            // 5. CREAR VENTA (AQUÍ SE CREA, NO ANTES)
            $venta = \App\Models\Venta::create([
                'fecha' => now(),
                'id_cliente' => $clienteId,
                'id_empleado' => 1, // Sistema
                'id_vehiculo' => $vehiculo->id_vehiculo,
                'id_seguro' => $seguro->id_seguro,
                'id_cotizacion' => $cotizacionDB->id_cotizacion,
                'monto_total' => $primaNumero,
            ]);

            // GUARDAR EN SESIÓN
            Session::put('cotizacion_automotriz.id_cotizacion', $cotizacionDB->id_cotizacion);
            Session::put('cotizacion_automotriz.id_venta', $venta->id_venta);

            // OPCIONAL: Crear póliza en estado "pendiente"
            $poliza = \App\Models\Poliza::create([
                'numero_poliza' => 'PEND-AUTO-' . $venta->id_venta,
                'fecha_emision' => now(),
                'fecha_vencimiento' => now()->addYear(),
                'estado' => 'pendiente',
                'id_vehiculo' => $vehiculo->id_vehiculo,
                'id_venta' => $venta->id_venta,
                'id_seguro' => $seguro->id_seguro, // AÑADIDO
                'monto_prima' => $primaNumero,
            ]);

            // === 6. FRANQUICIA (SOLO SI ELIGIÓ UNA) ===
            $franquiciaTipo = $cotizacion['franquicia_tipo'] ?? '500'; // por si viene vacío

            if ($franquiciaTipo !== 'ninguna') {
                // EL CLIENTE SÍ ELIGIÓ FRANQUICIA → CREAMOS EL REGISTRO
                $nombre = $franquiciaTipo === 'porcentaje_5'
                    ? 'Franquicia 5% del daño'
                    : "Franquicia {$franquiciaTipo} Bs";

                $monto = in_array($franquiciaTipo, ['300', '500', '800']) ? (float)$franquiciaTipo : null;
                $porcentaje = $franquiciaTipo === 'porcentaje_5' ? 5.00 : null;

                // Crear registro en tabla franquicias
                \App\Models\Franquicia::create([
                    'nombre' => $nombre,
                    'monto' => $monto,
                    'porcentaje' => $porcentaje,
                    'descripcion' => 'Franquicia seleccionada por el cliente',
                    'id_poliza' => $poliza->id_poliza,
                ]);
            }

            $prima = \App\Models\Prima::create([
                'id_poliza' => $poliza->id_poliza,
                'monto' => $primaNumero,
                'fecha_inicio' => now(),
                'fecha_fin' => now()->addYear(),
                'estado' => 'activa',
                'descripcion' => 'Prima anual - ' . ucfirst($cotizacion['tipo_cobertura']),
            ]);
            // 7. GUARDAR id_prima EN SESIÓN
            // Guardar en sesión
            Session::put('cotizacion_automotriz.id_venta', $venta->id_venta);
            Session::put('cotizacion_automotriz.id_prima', $prima->id_prima);

            return redirect()->route('automotriz.pago')
                ->with('success', 'Registro completado. Procede al pago.');
        });
    }
    private function registrarRequisitosParaSeguro($seguro, $tipoCobertura)
    {
        // 1. Definimos los requisitos según el tipo de cobertura
        $requisitosPorTipo = [
            'total' => [
                'CI del Propietario',
                'RUAT Original',
                'Inspección Técnica Vehicular',
                'Factura Original o Título de Propiedad',
                'Certificado de No Adeudar Impuestos (SAT)',
            ],
            'terceros' => [
                'CI del Propietario',
                'RUAT Original',
            ],
        ];

        $nombresRequisitos = $requisitosPorTipo[$tipoCobertura] ?? $requisitosPorTipo['terceros'];

        // 2. Recorremos y creamos/vinculamos cada requisito
        foreach ($nombresRequisitos as $nombre) {

            // Crea el requisito si no existe (evita duplicados)
            $requisito = \App\Models\Requisito::firstOrCreate(
                ['nombre' => $nombre],
                [
                    'descripcion' => 'Requisito obligatorio para póliza automotriz',
                    'tipo'        => 'documento',
                ]
            );

            // Vincula al seguro con la marca de obligatorio
            $seguro->requisitos()->syncWithoutDetaching([
                $requisito->id_requisito => ['obligatorio' => '1']
            ]);
        }
    }

    // === BUSCAR PLACA DESDE MODAL ===
    public function verificarPlaca(Request $request)
    {
        $request->validate(['placa' => 'required|string|max:10']);
        $placa = strtoupper(trim($request->placa));

        // BUSCAR VEHÍCULO CON PÓLIZA DE TIPO "Automotriz"
        $vehiculo = DB::table('vehiculos')
            ->join('ventas', 'vehiculos.id_vehiculo', '=', 'ventas.id_vehiculo')
            ->join('polizas', 'ventas.id_venta', '=', 'polizas.id_venta')
            ->join('seguros', 'polizas.id_seguro', '=', 'seguros.id_seguro')
            ->join('tipos_seguro', 'seguros.id_tipo', '=', 'tipos_seguro.id_tipo')
            ->where('vehiculos.placa', $placa)
            ->where('tipos_seguro.nombre', 'like', '%automotriz%')
            ->select('vehiculos.*', 'polizas.numero_poliza', 'polizas.id_poliza')
            ->first();

        if ($vehiculo) {
            return redirect()->route('automotriz')
                ->with('success', "Póliza vigente: {$vehiculo->numero_poliza}")
                ->with('poliza_id', $vehiculo->id_poliza);
        } else {
            return redirect()->route('automotriz.registrar-vehiculo')
                ->with('warning', "Placa no registrada en Automotriz. Regístrala para cotizar.")
                ->withInput(['placa' => $placa]);
        }
    }
    // === HOME (tu vista actual) ===
    public function home()
    {
        $polizaId = session('poliza_id');
        $poliza = $polizaId ? Poliza::find($polizaId) : null;

        return view('cliente.automotrizhome', compact('poliza'));
    }

    // === DESCARGAR PÓLIZA (PDF) ===
    public function descargarPoliza($id)
    {
        // ANTES (tú tenías esto)
        // $poliza = Poliza::with(['vehiculo.cliente', 'seguro'])->findOrFail($id);

        // AHORA (así sí carga la franquicia)
        $poliza = Poliza::with([
            'vehiculo.cliente',
            'vehiculo.modelo.marca',  // opcional, pero útil
            'seguro',
            'franquicia'              // ← ESTO ES LO QUE FALTABA
        ])->findOrFail($id);

        $prima = \App\Models\Prima::where('id_poliza', $poliza->id_poliza)->first();

        // Seguridad (puedes descomentar cuando quieras)
        // $cotizacion = session('cotizacion_automotriz');
        // if (!$cotizacion || $cotizacion['id_venta'] != $poliza->id_venta) {
        //     abort(403);
        // }

        return view('cliente.automotriz.poliza_pdf', compact('poliza', 'prima'));
    }
    private function getIdSeguroAutomotriz()
    {
        return 2; // Reemplaza con el ID real del seguro Automotriz
    }

    // === PASO 3: MOSTRAR QR ===
    public function pago()
    {
        $cotizacion = session('cotizacion_automotriz');

        if (!$cotizacion || !isset($cotizacion['id_venta']) || !isset($cotizacion['prima'])) {
            return redirect()->route('automotriz.registrar-vehiculo')
                ->with('error', 'Debes completar la cotización primero.');
        }

        $cliente = \App\Models\Cliente::find($cotizacion['cliente_id']);
        $prima = $cotizacion['prima'];
        $referencia = 'PANK' . str_pad($cotizacion['id_venta'], 6, '0', STR_PAD_LEFT);

        return view('cliente.automotriz.pago', compact('cotizacion', 'cliente', 'prima', 'referencia'));
    }

    // === SUBIR COMPROBANTE ===
    public function subirComprobante(Request $request)
    {
        $request->validate([
            'comprobante' => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $cotizacion = session('cotizacion_automotriz');
        if (!$cotizacion || !isset($cotizacion['id_venta'])) {
            return redirect()->route('automotriz.registrar-vehiculo');
        }

        $path = $request->file('comprobante')->store('comprobantes', 'public');

        // === FORZAMOS QUE EL MONTO SEA UN NÚMERO ENTERO (NUNCA MÁS ARRAY) ===
        $montoPago = 0;

        if (isset($cotizacion['prima'])) {
            $valor = $cotizacion['prima'];
            if (is_numeric($valor)) {
                $montoPago = (int) round($valor);
            } elseif (is_array($valor) && isset($valor['monto'])) {
                $montoPago = (int) round($valor['monto']);
            } elseif (is_object($valor) && isset($valor->monto)) {
                $montoPago = (int) round($valor->monto);
            }
        }

        // Si por algún motivo sigue en 0 → recalculamos al vuelo (nunca fallará)
        if ($montoPago <= 0) {
            $tasa = $cotizacion['tipo_cobertura'] === 'total' ? 0.25 : 0.15;
            $primaBase = $cotizacion['valor_comercial'] * $tasa;

            $descuentos = [
                'ninguna'      => 0.00,
                '300'          => 0.10,
                '500'          => 0.18,
                '800'          => 0.25,
                '1200'         => 0.30,
                'porcentaje_5' => 0.20,
            ];
            $descuento = $descuentos[$cotizacion['franquicia_tipo'] ?? '500'] ?? 0.18;

            $montoPago = (int) round($primaBase * (1 - $descuento));
        }
        \App\Models\Pago::create([
            'fecha' => now()->toDateString(),
            'monto' => $montoPago,
            'comprobante' => $path,
            'estado_pago' => 'pendiente',
            'referencia' => 'PANK' . $cotizacion['id_venta'],
            'id_venta' => $cotizacion['id_venta'],
            'id_prima' => $cotizacion['id_prima'], // ← ASIGNADO
            'confirmado_por' => null,
            'motivo_rechazo' => null,
        ]);

        return redirect()->route('automotriz.espera')
            ->with('status', 'Comprobante enviado. En espera de aprobación.');
    }

    // === VISTA ESPERA ===
    public function espera()
    {
        $cotizacion = session('cotizacion_automotriz');
        if (!$cotizacion || !isset($cotizacion['id_venta'])) {
            return redirect()->route('automotriz.registrar-vehiculo')
                ->with('error', 'Debes subir el comprobante primero.');
        }

        return view('cliente.automotriz.espera', compact('cotizacion'));
    }

    // === GENERAR PDF PÓLIZA (cuando admin apruebe) ===
    public function generarPoliza($cotizacion_id)
    {
        $cotizacion = session('cotizacion_automotriz');
        $cliente = \App\Models\Cliente::find($cotizacion['cliente_id']);
        $vehiculo = \App\Models\Vehiculo::where('id_cliente', $cliente->id_cliente)->first();

        // GENERAR NÚMERO DE PÓLIZA
        $numeroPoliza = 'POL-AUTO-' . str_pad($cotizacion_id, 6, '0', STR_PAD_LEFT);

        // CREAR PÓLIZA
        $poliza = \App\Models\Poliza::create([
            'numero_poliza' => $numeroPoliza,
            'fecha_emision' => now(),
            'fecha_vencimiento' => now()->addYear(),
            'estado' => 'vigente',
            'id_vehiculo' => $vehiculo->id_vehiculo,
            'monto_prima' => $cotizacion['prima'],
        ]);

        // GENERAR PDF
        $pdf = Pdf::loadView('automotriz.poliza_pdf', compact('poliza', 'cliente', 'vehiculo', 'cotizacion'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download("Poliza_{$numeroPoliza}.pdf");
    }

    public function verificarPago(Request $request)
    {
        $ventaId = $request->query('venta_id');
        $cotizacionSesion = session('cotizacion_automotriz');

        if (!$cotizacionSesion || $cotizacionSesion['id_venta'] != $ventaId) {
            return response()->json(['html' => 'Error de sesión', 'estado' => 'error']);
        }

        $pago = \App\Models\Pago::where('id_venta', $ventaId)->first();

        if (!$pago || $pago->estado === 'pendiente') {
            $html = view('cliente.automotriz.partials._pendiente')->render();
            return response()->json(['html' => $html, 'estado' => 'pendiente']);
        }

        if ($pago->estado === 'confirmado') {
            $poliza = \App\Models\Poliza::where('id_venta', $ventaId)->first();
            $html = view('cliente.automotriz.partials._aprobado', compact('poliza'))->render();
            return response()->json(['html' => $html, 'estado' => 'aprobado']);
        }

        if ($pago->estado === 'rechazado') {
            $html = view('cliente.automotriz.partials._rechazado', compact('pago'))->render();
            return response()->json(['html' => $html, 'estado' => 'rechazado']);
        }
    }
}
