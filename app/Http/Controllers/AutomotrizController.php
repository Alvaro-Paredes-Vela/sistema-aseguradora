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
        ]);

        return redirect()->route('automotriz.cotizar-paso2');
    }
    // === PASO 2: COTIZAR PRIMA ===
    public function cotizarPaso2()
    {
        $datos = Session::get('cotizacion_automotriz');
        if (!$datos) {
            return redirect()->route('automotriz.registrar-vehiculo')->with('error', 'Debes registrar el vehículo primero.');
        }

        $prima = $this->calcularPrima($datos);

        return view('cliente.automotriz.cotizar_paso2', compact('datos', 'prima'));
    }

    private function calcularPrima($datos)
    {
        $valor = $datos['valor_comercial'];
        $tipo = $datos['tipo_cobertura'];
        $uso = $datos['uso_vehiculo'];
        $region = $datos['region'];

        // Base: porcentaje del valor comercial
        $porcentajes = [
            'total' => 0.045,    // 4.5% del valor
            'terceros' => 0.018  // 1.8% del valor
        ];

        $prima = $valor * $porcentajes[$tipo];

        // Ajuste por uso
        if ($uso === 'publico') {
            $prima *= 1.5;
        }

        // Ajuste por región (riesgo)
        $multiplicadores = [
            'santa_cruz' => 1.0,
            'la_paz' => 1.3,
            'cochabamba' => 1.1,
            'oruro' => 1.2,
            'potosi' => 1.15,
            'beni' => 1.05,
            'pando' => 1.05,
            'chuquisaca' => 1.08,
            'tarija' => 1.1
        ];

        $prima *= $multiplicadores[$region];

        // Redondear a 2 decimales
        return round($prima);
    }

    public function confirmarCotizacion(Request $request)
    {
        $datos = Session::get('cotizacion_automotriz');
        if (!$datos) {
            return redirect()->route('automotriz.registrar-vehiculo')
                ->with('error', 'Debes registrar el vehículo primero.');
        }

        $prima = $this->calcularPrima($datos);

        // SOLO GUARDA LA PRIMA
        Session::put('cotizacion_automotriz.prima', $prima);

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

            $seguro = \App\Models\Seguro::create([
                'nombre' => $nombreSeguro,
                'id_tipo' => $idTipoAutomotriz,
                'id_categoria' => 2,
                //vigenicia 1 año dato esta en date
                'vigencia' => 12,
                'precio' => $cotizacion['prima'],
            ]);

            // 4. CREAR COTIZACIÓN
            $cotizacionDB = \App\Models\Cotizacion::create([
                'precio_total' => $cotizacion['prima'],
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
                'monto_total' => $cotizacion['prima'],
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
                'monto_prima' => $cotizacion['prima'],
            ]);

            $prima = \App\Models\Prima::create([
                'id_poliza' => $poliza->id_poliza,
                'monto' => $cotizacion['prima'],
                'fecha_inicio' => now(),
                'fecha_fin' => now()->addYear(),
                'estado' => 'activa',
                'descripcion' => 'Prima anual - ' . ucfirst($cotizacion['tipo_cobertura']),
            ]);
            // 7. GUARDAR id_prima EN SESIÓN
            Session::put('cotizacion_automotriz.id_prima', $prima->id_prima);

            return redirect()->route('automotriz.pago')
                ->with('success', 'Registro completado. Procede al pago.');
        });
    }
    private function getIdSeguro($tipo)
    {
        return \App\Models\Seguro::where('nombre', 'like', "%$tipo%")->first()->id_seguro;
        // O mejor: crea un campo 'tipo_seguro' en la tabla seguros
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
        $poliza = Poliza::with(['vehiculo.cliente', 'seguro'])->findOrFail($id);

        // CARGAR PRIMA MANUALMENTE (SIN RELACIÓN)
        $prima = \App\Models\Prima::where('id_poliza', $poliza->id_poliza)->first();

        // Seguridad
        $cotizacion = session('cotizacion_automotriz');
        //if (!$cotizacion || $cotizacion['id_venta'] != $poliza->id_venta) {
        //abort(403);
        //}
        // Aquí generarás el PDF (más adelante)
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

        \App\Models\Pago::create([
            'fecha' => now()->toDateString(),
            'monto' => $cotizacion['prima'],
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
