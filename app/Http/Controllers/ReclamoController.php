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
        $reclamos = Reclamo::latest('fecha_reclamo')->paginate(10);
        return view('reclamos.index', compact('reclamos'));
    }

    /**
     * Mostrar formulario público "Contáctanos"
     */
    public function create()
    {
        return view('reclamos.store');
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
        return view('reclamos.show', compact('reclamo'));
    }

    /**
     * Formulario para editar estado (admin)
     */
    public function edit(Reclamo $reclamo)
    {
        return view('reclamos.edit', compact('reclamo'));
    }

    /**
     * Actualizar estado del reclamo
     */
    public function update(Request $request, Reclamo $reclamo)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,resuelto,rechazado',
            'respuesta' => 'nullable|string', // si quieres agregar respuesta
        ]);

        $reclamo->update([
            'estado' => $request->estado,
            // 'respuesta' => $request->respuesta,
        ]);

        return redirect()->route('reclamos.index')
            ->with('success', 'Estado del reclamo actualizado.');
    }

    /**
     * Eliminar reclamo (admin)
     */
    public function destroy(Reclamo $reclamo)
    {
        $reclamo->delete();

        return redirect()->route('reclamos.index')
            ->with('success', 'Reclamo eliminado.');
    }
}
