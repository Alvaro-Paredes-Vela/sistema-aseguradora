<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoSeguro;
use Illuminate\Support\Facades\Session;

class TipoSeguroController extends Controller
{
    private function verificarEmpleado()
    {
        if (!Session::has('empleado_id')) {
            return redirect()->route('admin.login')->with('error', 'Inicia sesión.');
        }
        return null; // Cualquier empleado autenticado puede acceder
    }

    public function index()
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $tipos = TipoSeguro::orderBy('nombre')->get();
        return view('Tipos-Seguro.index', compact('tipos'));
    }

    public function create()
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        return view('Tipos-Seguro.create');
    }

    public function store(Request $request)
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $request->validate([
            'nombre' => 'required|string|max:100|unique:tipos_seguro',
            'descripcion' => 'nullable|string'
        ]);

        TipoSeguro::create($request->only('nombre', 'descripcion'));

        return redirect()->route('tipos-seguro.index')->with('success', 'Tipo creado.');
    }

    public function edit($id_tipo)
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $tipo = TipoSeguro::findOrFail($id_tipo);
        return view('Tipos-Seguro.edit', compact('tipo'));
    }

    public function update(Request $request, $id_tipo)
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $request->validate([
            'nombre' => 'required|string|max:100|unique:tipos_seguro,nombre,' . $id_tipo . ',id_tipo',
            'descripcion' => 'nullable|string'
        ]);

        $tipo = TipoSeguro::findOrFail($id_tipo);
        $tipo->update($request->only('nombre', 'descripcion'));

        return redirect()->route('tipos-seguro.index')->with('success', 'Tipo actualizado.');
    }

    public function destroy($id_tipo)
    {
        $redirect = $this->verificarEmpleado();
        if ($redirect) return $redirect;

        $tipo = TipoSeguro::findOrFail($id_tipo);

        if ($tipo->seguros()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: tiene seguros asociados.');
        }

        $tipo->delete();

        return back()->with('success', 'Tipo eliminado.');
    }
}
