<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Pago;
use App\Models\Poliza;

class PagoPendienteController extends Controller
{
    private function verificarEmpleado()
    {
        if (!Session::has('empleado_id')) {
            return redirect()->route('admin.login')
                ->with('error', 'Inicia sesión para continuar.');
        }
        return null;
    }

    /**
     * Muestra todos los pagos pendientes.
     */
    public function index()
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $pagos = Pago::with(['venta.cliente', 'venta.vehiculo', 'venta.seguro'])
            ->where('estado_pago', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pagos-pendientes.index', compact('pagos'));
    }

    /**
     * Aprueba un pago y genera la póliza.
     */
    public function aprobar(Pago $pago)
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        if ($pago->estado_pago !== 'pendiente') {
            return back()->with('error', 'Este pago ya fue procesado.');
        }

        $poliza = Poliza::where('id_venta', $pago->id_venta)->firstOrFail();

        // GENERAR NÚMERO SECUENCIAL
        $ultimo = Poliza::whereNotNull('numero_poliza')->max('id_poliza') ?? 0;
        $nuevoNumero = 'SOAT-' . str_pad($ultimo + 1, 6, '0', STR_PAD_LEFT);

        // VERIFICAR QUE NO EXISTA
        while (Poliza::where('numero_poliza', $nuevoNumero)->exists()) {
            $ultimo++;
            $nuevoNumero = 'SOAT-' . str_pad($ultimo + 1, 6, '0', STR_PAD_LEFT);
        }

        // ACTUALIZAR PÓLIZA EXISTENTE
        $poliza->update([
            'numero_poliza' => $nuevoNumero,
            'fecha_emision' => now(),
            'fecha_vencimiento' => now()->addYear(),
            'estado' => 'vigente', // CAMBIA 'activa' → 'vigente'
        ]);

        // APROBAR PAGO
        $pago->update([
            'estado_pago' => 'confirmado',
            'confirmado_por' => Session::get('empleado_id'),
        ]);

        return redirect()->route('admin.index')
            ->with('success', "Pago aprobado. Póliza #{$poliza->numero_poliza} activada.");
    }

    public function rechazar(Request $request, Pago $pago)
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $request->validate(['motivo' => 'required|string|max:255']);

        if ($pago->estado_pago !== 'pendiente') {
            return back()->with('error', 'Este pago ya fue procesado.');
        }

        $pago->estado_pago = 'rechazado';
        $pago->motivo_rechazo = $request->motivo;
        $pago->save();

        if ($pago->comprobante) {
            Storage::disk('public')->delete($pago->comprobante);
            $pago->comprobante = null;
            $pago->save();
        }

        // CAMBIO CLAVE: REDIRECCIONAR A INDEX
        return redirect()->route('admin.index')
            ->with('success', 'Pago rechazado correctamente.');
    }

    public function aprobados()
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $pagos = Pago::with([
            'venta.cliente',
            'venta.vehiculo',
            'confirmadoPor' // ← RELACIÓN DEFINIDA EN Pago.php
        ])
            ->where('estado_pago', 'confirmado')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.Pagos-Pendientes.aprobados', compact('pagos'));
    }

    public function rechazados()
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $pagos = Pago::with(['venta.cliente', 'venta.vehiculo'])
            ->where('estado_pago', 'rechazado')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.Pagos-Pendientes.rechazados', compact('pagos'));
    }
}
