<?php

namespace App\Http\Controllers;

use App\Models\Reclamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReclamoRecibido; // Opcional: si quieres enviar email

class ReclamoController extends Controller
{
    /**
     * Mostrar lista de reclamos (panel admin)
     */
    public function index()
    {
        $reclamos = Reclamo::with(['cliente', 'empleado']) // Carga relaciones
            ->orderByRaw("FIELD(estado, 'pendiente', 'en_proceso', 'resuelto', 'rechazado')")
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.reclamos.index', compact('reclamos'));
    }

    /**
     * Mostrar formulario público "Contáctanos"
     */
    public function create()
    {
        return view('cliente.contactar');
    }

    /**
     * Guardar nuevo reclamo desde el formulario
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mensaje' => 'required|string|min:10',
        ]);

        Reclamo::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'mensaje' => $request->mensaje,
            'fecha_reclamo' => now()->toDateString(),
            'estado' => 'pendiente',
            'id_cliente' => auth('cliente')->id(),
        ]);

        return redirect()->back()->with('success', '¡Reclamo enviado con éxito!');
    }
    /**
     * Mostrar un reclamo específico (admin)
     */
    public function show(Reclamo $reclamo)
    {
        $reclamo->load('cliente', 'empleado'); // Carga relaciones si no están
        return view('admin.reclamos.show', compact('reclamo'));
    }

    /**
     * Formulario para cambiar estado (empleado)
     */
    public function edit(Reclamo $reclamo)
    {
        $empleados = \App\Models\Empleado::select('id_empleado', 'nombres', 'paterno')->get();
        return view('admin.reclamos.edit', compact('reclamo', 'empleados'));
    }

    /**
     * Actualizar estado + asignar empleado
     */
    public function update(Request $request, Reclamo $reclamo)
    {
        $request->validate([
            'estado'       => 'required|in:pendiente,en_proceso,resuelto,rechazado',
            'id_empleado'  => 'nullable|exists:empleados,id_empleado',
        ]);

        $reclamo->update([
            'estado'       => $request->estado,
            'id_empleado'  => $request->id_empleado ?? $reclamo->id_empleado,
        ]);

        return redirect()->route('reclamos.index')
            ->with('success', 'Estado del reclamo actualizado correctamente.');
    }

    /**
     * Eliminar reclamo (solo admin o superusuario)
     */
    public function destroy(Reclamo $reclamo)
    {
        $reclamo->delete();

        return back()->with('success', 'Reclamo eliminado permanentemente.');
    }
}
