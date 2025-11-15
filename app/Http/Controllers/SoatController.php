<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Poliza;
use App\Models\Venta;
use App\Models\Prima;
use App\Models\Pago;
use App\Models\Factura;
use App\Models\Seguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;


class SoatController extends Controller
{
    private function authCliente()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('cliente.login')->with('error', 'Inicia sesión');
        }
        return true;
    }

    /* 1. DASHBOARD SOAT (lista vehículos del cliente)
    public function index()
    {
        if (!$this->authCliente()) return $this->authCliente();

        $cliente = \App\Models\Cliente::with('vehiculos')->find(Session::get('cliente_id'));
        return view('cliente.home', compact('cliente'));
    }
*/
    // 1. BUSCAR VEHÍCULO (público o logueado)
    public function buscarForm()
    {
        return view('cliente.Comprar-Soat.buscar-vehiculo');
    }

    public function buscar(Request $request)
    {
        $request->validate(['placa' => 'required|string|max:15']);
        $placa = strtoupper($request->placa);

        $vehiculo = Vehiculo::where('placa', $placa)->first();

        // === FIJADO: VERIFICA NULL ANTES DE POLIZAS ===
        if (!$vehiculo) {
            return back()
                ->with('error', 'Vehículo no encontrado. Regístralo primero.')
                ->with('placa_buscada', $placa);
        }

        // SESSION VEHICULO (para vista)
        session(['vehiculo' => $vehiculo]);

        // VERIFICA SOAT VIGENTE (solo si existe vehículo)
        $polizaVigente = $vehiculo->polizas()
            ->where('estado', 'vigente')
            ->where('fecha_vencimiento', '>', now())
            ->first();  // Usa first() para datos

        if ($polizaVigente) {
            return back()
                ->with('soat_vigente', true)
                ->with('soat_vencimiento', $polizaVigente->fecha_vencimiento->format('d/m/Y'))
                ->with('poliza_id', $polizaVigente->id_poliza)
                ->with('success', '¡SOAT vigente encontrado! Descarga tu póliza.');
        }

        // NO VIGENTE → PAGO
        return redirect()->route('soat.buscar', $placa);
    }

    /**
     * Devuelve el ID del seguro SOAT (crea solo una vez)
     */
    private function getSoatSeguroId()
    {
        // CACHÉ ESTÁTICA: solo se crea una vez por request
        static $soatId = null;

        if ($soatId !== null) {
            return $soatId;
        }

        // BUSCAR EN BD
        $seguro = \App\Models\Seguro::where('nombre', 'SOAT')->first();

        if ($seguro) {
            $soatId = $seguro->id_seguro;
            return $soatId;
        }

        // CREAR UNA SOLA VEZ
        $seguro = \App\Models\Seguro::create([
            'nombre' => 'SOAT',
            'vigencia' => 365,
            'id_categoria' => 1,
            'id_tipo' => 1,
        ]);

        // GUARDAR EN HISTORIAL
        \App\Models\HistorialPrecio::create([
            'fecha' => now()->toDateString(),
            'precio' => 200, // Precio inicial (puedes poner base) precio base = 200
            'id_seguro' => $seguro->id_seguro,
        ]);

        $soatId = $seguro->id_seguro;
        return $soatId;
    }

    // NUEVA RUTA LIMPIAR
    public function limpiarResultado()
    {
        Session::forget(['vehiculo', 'soat_vigente', 'soat_vencimiento', 'poliza_id', 'error']);
        return response()->json(['status' => 'ok']);
    }

    /*
    public function limpiarPlaca()
    {
        Session::forget('placa_buscada');
        return response()->json(['status' => 'ok']);
    }
    */

    // 2. PRECIO SOAT (helper unificado)
    private function calcularPrecioSOAT($tipo, $uso, $region)
    {
        $precios = [
            'motocicleta'   => ['particular' => 200, 'publico' => 155],
            'automovil'     => ['particular' => 90,  'publico' => 120],
            'jeep'          => ['particular' => 110, 'publico' => 75],
            'camioneta'     => ['particular' => 140, 'publico' => 190],
            'vagoneta'      => ['particular' => 90,  'publico' => 125],
            'microbus'      => ['particular' => 460, 'publico' => 315],
            'colectivo'     => ['particular' => 595, 'publico' => 335],
            'omnibus_flota' => ['particular' => 2630, 'publico' => 3700],
            'tracto_camion' => ['particular' => 290, 'publico' => 185],
            'minibus_8'     => ['particular' => 140, 'publico' => 125],
            'minibus_11'    => ['particular' => 200, 'publico' => 190],
            'minibus_15'    => ['particular' => 330, 'publico' => 245],
            'camion_3'      => ['particular' => 330, 'publico' => 195],
            'camion_18'     => ['particular' => 1020, 'publico' => 975],
            'camion_25'     => ['particular' => 1310, 'publico' => 1260],
        ];

        $base = $precios[$tipo][$uso] ?? 0;
        return match ($region) {
            'santa_cruz' => $base * 1,
            'la_paz', 'cochabamba' => $base * 1,
            default => $base,
        };
    }

    // 3. FORM PAGO
    public function pagoForm($placa)
    {
        $vehiculo = Vehiculo::with('cliente')->where('placa', $placa)->firstOrFail();
        $precio = $this->calcularPrecioSOAT($vehiculo->tipo_vehiculo, $vehiculo->uso_vehiculo, $vehiculo->region);

        return view('cliente.Comprar-Soat.pago', compact('vehiculo', 'precio'));
    }

    // 4. GUARDAR DATOS VEHÍCULO
    public function pagoStore(Request $request)
    {
        $request->validate([
            'placa' => 'required|exists:vehiculos,placa',
            'color' => 'required|string|max:50',
            'nro_chasis' => 'required|string|max:50',
            'nro_motor' => 'required|string|max:50',
            'cilindrada' => 'required|integer|min:50',
            'tipo_combustible' => 'required|in:gasolina,diesel,gnv,electrico',
            'kilometraje' => 'required|integer|min:0',
            'valor_comercial' => 'required|numeric|min:1000',
        ]);

        $vehiculo = Vehiculo::with('cliente')->where('placa', $request->placa)->firstOrFail();
        $precio = $this->calcularPrecioSOAT($vehiculo->tipo_vehiculo, $vehiculo->uso_vehiculo, $vehiculo->region);

        return DB::transaction(function () use ($request, $vehiculo, $precio) {
            // 1. GENERAR RUAT ÚNICO
            do {
                $ruat = 'RUAT-' . strtoupper(Str::random(3)) . '-' . rand(100000, 999999);
            } while (Vehiculo::where('RUAT', $ruat)->exists());

            // 2. ACTUALIZAR VEHÍCULO + RUAT
            $vehiculo->update(array_merge(
                $request->only([
                    'color',
                    'nro_chasis',
                    'nro_motor',
                    'cilindrada',
                    'tipo_combustible',
                    'kilometraje',
                    'valor_comercial'
                ]),
                ['RUAT' => $ruat]
            ));

            // 3. CREAR VENTA
            $venta = Venta::create([
                'fecha' => now(),
                'id_cliente' => $vehiculo->id_cliente,
                'id_empleado' => 1, // SOAT online
                'id_vehiculo' => $vehiculo->id_vehiculo,
                'id_seguro' => $this->getSoatSeguroId(), // Debes tener este método
                'id_cotizacion' => null,
                'monto_total' => $precio,
            ]);

            // 4. CREAR PÓLIZA PENDIENTE
            Poliza::create([
                //'numero_poliza' => 'SOAT-' . $venta->id_venta,
                'fecha_emision' => now(),
                'fecha_vencimiento' => now()->addYear(),
                'estado' => 'pendiente',
                'id_vehiculo' => $vehiculo->id_vehiculo,
                'id_seguro' => $this->getSoatSeguroId(),
                'id_venta' => $venta->id_venta,
            ]);

            // 5. REDIRIGIR A QR CON DATOS
            return redirect()->route('soat.qr', [
                'placa' => $vehiculo->placa,
                'venta_id' => $venta->id_venta,
                'precio' => $precio,
                'RUAT' => $ruat,
            ])->with('success', 'Datos guardados. Procede al pago.');
        });
    }

    // 5. QR PAGO
    public function qr(Request $request, $placa)
    {
        $vehiculo = Vehiculo::where('placa', $placa)->firstOrFail();
        $venta_id = $request->query('venta_id');
        $venta = Venta::findOrFail($venta_id);

        if ($venta->id_vehiculo !== $vehiculo->id_vehiculo) {
            abort(404);
        }

        // OBTENER DATOS DEL QUERY (con fallback a DB)
        $precio = $request->query('precio', $venta->monto_total);
        $ruat = $request->query('RUAT') ? urldecode($request->query('RUAT')) : $vehiculo->RUAT;

        /* DIAGNÓSTICO
        dd([
            'url_completa' => $request->fullUrl(),
            'query_ruat' => $request->query('ruat'),
            'query_precio' => $request->query('precio'),
            'query_venta_id' => $request->query('venta_id'),
            'vehiculo_ruat' => $vehiculo->ruat,
            'venta_monto' => $venta->monto_total,
        ]);*/

        // GENERAR REFERENCIA
        $referencia = 'SOAT-' . $venta->id_venta . '-' . strtoupper(substr(md5($venta->id_venta . now()), 0, 6));

        // URL PARA EL BOTÓN "YA PAGUÉ"
        $pagoUrl = route('soat.comprar', [
            'venta_id' => $venta->id_venta,
            'precio' => $precio,
            'RUAT' => $ruat,
        ]);

        // TU IMAGEN QR ESTÁTICA (pero con data real)
        $qrImagePath = asset('img/qr-banca-movil.jpeg');

        return view('cliente.Comprar-Soat.pago-qr', [
            'venta' => $venta,
            'vehiculo' => $vehiculo,
            'precio' => $precio,
            'RUAT' => $ruat,
            'referencia' => $referencia,
            'qrImagePath' => $qrImagePath,
            'pagoUrl' => $pagoUrl,
        ]);
    }

    // 6. CONFIRMAR PAGO Y GENERAR TODO

    // 7. COMPROBANTE VISTA
    public function comprobante($venta_id)
    {
        // CARGAR TODO CON EAGER LOADING ANIDADO
        $venta = Venta::with([
            'cliente',
            'vehiculo.modelo.marca',  // ← CLAVE: carga marca sin paquetes
            'seguro',
            'polizas',
            'pagos'
        ])->findOrFail($venta_id);

        // Opcional: si poliza y pago no están en relaciones, búscalos aquí
        $poliza = $venta->poliza ?? Poliza::where('id_venta', $venta_id)->firstOrFail();
        $pago = $venta->pago ?? Pago::where('id_venta', $venta_id)->firstOrFail();

        // GENERAR PDF
        $pdf = PDF::loadView('cliente.Comprar-Soat.comprobante', compact('venta', 'poliza', 'pago'));

        // Nombre del archivo
        $filename = 'SOAT-' . $poliza->numero_poliza . '.pdf';

        // Stream (ver en navegador) o download
        return $pdf->stream($filename);
        // return $pdf->download($filename); // ← Si quieres forzar descarga
    }

    /* 8. DESCARGAR PDF
    public function descargarPdf($id)
    {
        $poliza = Poliza::with('vehiculo.cliente', 'vehiculo.marca', 'vehiculo.modelo', 'venta.factura')->findOrFail($id);

        // QR EN PDF
        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);
        $qrPoliza = (new QRCode($options))->render($poliza->codigo_qr);

        $pdf = Pdf::loadView('cliente.Comprar-Soat.poliza', compact('poliza', 'qrPoliza'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('SOAT-' . $poliza->placa . '-' . date('Y') . '.pdf');
    }*/

    /*==================================================================================================**/

    // app/Http/Controllers/SoatController.php → espera()
    public function espera($venta_id)
    {
        $venta = Venta::with('vehiculo')->findOrFail($venta_id);
        // RECARGA EL VEHÍCULO
        $venta->vehiculo->refresh();
        return view('cliente.Comprar-Soat.espera', compact('venta'));
    }

    public function confirmarPago(Request $request)
    {
        $request->validate([
            'venta_id' => 'required|exists:ventas,id_venta',
            'comprobante' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB
        ]);

        $venta = Venta::findOrFail($request->venta_id);

        // 1. GUARDAR COMPROBANTE
        $path = $request->file('comprobante')->store('comprobantes', 'public');

        // 2. GENERAR REFERENCIA ÚNICA
        $referencia = 'SOAT-' . $venta->id_venta . '-' . strtoupper(substr(md5($venta->id_venta . now()), 0, 6));



        // EL MONTO YA ESTÁ EN LA VENTA
        $monto = $venta->monto_total;

        $pago = Pago::create([
            'fecha' => now()->toDateString(),
            'monto' => $monto,
            'comprobante' => $path,
            'estado_pago' => 'pendiente',
            'referencia' => $referencia,
            'id_venta' => $venta->id_venta,
            'id_prima' => null, // Ajusta si usas primas
        ]);
        $this->crearFactura($venta, $pago);
        // 4. REDIRIGIR A ESPERA
        return redirect()->route('soat.espera', $venta->id_venta)
            ->with('success', 'Comprobante enviado. Estamos verificando tu pago...');
    }

    // app/Http/Controllers/SoatController.php

    public function comprobarForm()
    {
        return view('cliente.loginComprobante');
    }

    public function comprobar(Request $request)
    {
        $request->validate([
            'ruat' => 'required|string',
            'placa' => 'required|string|max:15',
        ]);

        $placa = strtoupper($request->placa);
        $ruat = strtoupper($request->ruat);

        $vehiculo = Vehiculo::where('RUAT', $ruat)
            ->where('placa', $placa)
            ->first();

        if (!$vehiculo) {
            return back()->with('error', 'No se encontró un vehículo con esos datos.');
        }

        $poliza = $vehiculo->polizas()
            ->where('estado', 'vigente') // 'vigente' NO 'activa'
            ->where('fecha_vencimiento', '>', now())
            ->first();

        if (!$poliza) {
            return back()->with('error', 'No tienes un SOAT vigente. El pago aún no ha sido aprobado.');
        }

        return redirect()->route('soat.comprobante', $poliza->id_venta);
    }

    public function verificarForm()
    {
        return view('cliente.verificar-vigencia');
    }

    // SoatController.php
    public function verificar(Request $request)
    {
        $request->validate([
            'busqueda' => 'required|string|max:50',
        ]);

        $busqueda = strtoupper(trim($request->busqueda));

        $vehiculo = \App\Models\Vehiculo::where(function ($query) use ($busqueda) {
            $query->where('placa', $busqueda)
                ->orWhere('RUAT', $busqueda);
        })->first();

        if (!$vehiculo) {
            return back()->with('error', 'No se encontró un vehículo con esos datos26.');
        }

        $poliza = $vehiculo->polizas()
            ->where('estado', 'vigente')
            ->where('fecha_vencimiento', '>', now())
            ->first();

        if (!$poliza) {
            return back()->with('error', 'No tienes un SOAT vigente.');
        }

        return back()->with([
            'poliza' => [
                'id_venta' => $poliza->id_venta,
                'fecha_vencimiento' => \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y'),
                'vehiculo' => $vehiculo->placa . ' - ' . ($vehiculo->modelo?->nombre ?? 'Sin modelo'),
            ]
        ]);
    }

    public function descargarPoliza($id)
    {
        // Cargar póliza con relaciones
        $poliza = Poliza::with([
            'vehiculo.cliente',
            'vehiculo.modelo.marca',
            'venta.pagos'
        ])->findOrFail($id);

        // Buscar venta y pago (como en tu comprobante)
        $venta = $poliza->venta;
        $pago = $venta->pagos->first();

        // GENERAR PDF CON TU VISTA comprobante
        $pdf = Pdf::loadView('cliente.Comprar-Soat.comprobante', compact('venta', 'poliza', 'pago'));

        // Configurar
        $pdf->setPaper('A4', 'portrait');

        // Descargar
        return $pdf->download("SOAT_{$poliza->numero_poliza}.pdf");
    }

    public function descargarPolizaVigente($id)
    {
        $poliza = Poliza::with(['vehiculo.cliente', 'vehiculo.modelo.marca', 'vehiculo.modelo', 'venta.pagos'])->findOrFail($id);
        $pago = $poliza->venta->pagos->first();

        return view('cliente.Comprar-Soat.poliza', compact('poliza', 'pago'));
    }

    private function numeroALetras($numero)
    {
        $unidades = ['', 'UN', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'];
        $decenas = ['DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO', 'DIECINUEVE'];
        $veintes = ['VEINTE', 'VEINTI', 'TREINTA', 'CUARENTA', 'CINCUENTA', 'SESENTA', 'SETENTA', 'OCHENTA', 'NOVENTA'];
        $centenas = ['CIENTO', 'DOSCIENTOS', 'TRESCIENTOS', 'CUATROCIENTOS', 'QUINIENTOS', 'SEISCIENTOS', 'SETECIENTOS', 'OCHOCIENTOS', 'NOVECIENTOS'];

        if ($numero == 0) return 'CERO';

        $entero = floor($numero);
        $palabras = '';

        // MILLONES
        if ($entero >= 1000000) {
            $palabras .= $this->numeroALetras($entero / 1000000) . ' MILLONES ';
            $entero %= 1000000;
        }

        // MILES
        if ($entero >= 1000) {
            if ($entero == 1000) {
                $palabras .= 'MIL ';
            } else {
                $palabras .= $this->numeroALetras(floor($entero / 1000)) . ' MIL ';
            }
            $entero %= 1000;
        }

        // CENTENAS
        if ($entero >= 100) {
            $palabras .= $centenas[floor($entero / 100) - 1] . ' ';
            $entero %= 100;
            if ($entero == 0) return trim($palabras);
        }

        // DECENAS Y UNIDADES
        if ($entero >= 20) {
            $decena = floor($entero / 10);
            $unidad = $entero % 10;

            if ($decena == 2 && $unidad > 0) {
                $palabras .= 'VEINTI' . ($unidad == 1 ? '' : $unidades[$unidad]);
            } else {
                $palabras .= $veintes[$decena - 1];
                if ($unidad > 0) {
                    $palabras .= ' Y ' . $unidades[$unidad];
                }
            }
            $palabras .= ' ';
        } elseif ($entero >= 10) {
            $palabras .= $decenas[$entero - 10] . ' ';
        } elseif ($entero > 0) {
            $palabras .= $unidades[$entero] . ' ';
        }

        return trim($palabras);
    }

    public function crearFactura($venta, $pago)
    {
        $nroFactura = Factura::max('nro_factura') + 1 ?? 1;
        $monto = $pago->monto;

        // Código de control
        $codigoControl = strtoupper(Str::random(2)) . '-' . strtoupper(Str::random(2)) . '-' . strtoupper(Str::random(2)) . '-' . strtoupper(Str::random(2));

        // Fecha límite
        $fechaLimite = now();

        $entero = floor($monto);
        $decimal = round(($monto - $entero) * 100);
        $sonLetras = ucfirst($this->numeroALetras($entero)) . " CON " . sprintf("%02d", $decimal) . "/100 BOLIVIANOS";

        // Razón social
        $cliente = $venta->cliente;
        $razonSocial = trim($cliente->nombre . ' ' . $cliente->paterno . ' ' . $cliente->materno);

        // Descripción
        $descripcion = "SOAT PLACA " . $venta->vehiculo->placa;

        // CREAR FACTURA
        return Factura::create([
            'nro_factura' => $nroFactura,
            'fecha_emision' => now(),
            'monto' => $monto,
            'monto_iva' => 0,
            'descripcion' => $descripcion,
            'estado' => 'emitida',
            'id_pago' => $pago->id_pago,
            'razon_social' => $razonSocial,
            'codigo_control' => $codigoControl,
            'fecha_limite_emision' => $fechaLimite,
            'son_letras' => $sonLetras,
        ]);
    }

    // SoatController.php
    public function descargarFactura($nro)
    {
        $factura = Factura::findOrFail($nro);
        $venta = Venta::find($factura->pago->id_venta);
        $poliza = Poliza::where('id_venta', $venta->id_venta)->first();

        $pdf = Pdf::loadView('cliente.Comprar-Soat.factura', compact('factura', 'venta', 'poliza'));
        return $pdf->download('factura-' . $nro . '.pdf');
    }
}
