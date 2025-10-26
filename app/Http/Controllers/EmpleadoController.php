<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!session('empleado_id')) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }

        // Aquí va la lógica para mostrar el dashboard (admin.index)
        return view('admin.index'); // Asegúrate de tener esta vista
    }

    public function create()
    {
        return view('empleado.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|unique:empleados|max:50',
            'clave' => 'required|max:100',
            'correo' => 'required|email|max:100',
            'rol' => 'required|max:100',
            'contratacion' => 'nullable|date',
            'estado' => 'boolean',
            'nombres' => 'nullable|max:50',
            'paterno' => 'nullable|max:50',
            'materno' => 'nullable|max:50',
            'nro_telefono' => 'nullable|max:15',
        ]);

        Empleado::create($request->all());

        return redirect()->route('admin.login')->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    public function show($id_empleado)
    {
        $empleado = Empleado::findOrFail($id_empleado);
        return view('empleado.show', compact('empleado'));
    }

    public function edit($id_empleado)
    {
        $empleado = Empleado::findOrFail($id_empleado);
        return view('empleado.edit', compact('empleado'));
    }

    public function update(Request $request, $id_empleado)
    {
        // Verificar si el usuario está autenticado
        if (!session('empleado_id')) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }

        $request->validate([
            'login' => 'required|max:50|unique:empleados,login,' . $id_empleado . ',id_empleado',
            'clave' => 'nullable|max:100',
            'correo' => 'required|email|max:100',
            'rol' => 'required|max:100',
            'contratacion' => 'nullable|date',
            'estado' => 'boolean',
            'nombres' => 'nullable|max:50',
            'paterno' => 'nullable|max:50',
            'materno' => 'nullable|max:50',
            'nro_telefono' => 'nullable|max:15',
        ]);

        $empleado = Empleado::findOrFail($id_empleado);
        $data = $request->all();

        if (!empty($data['clave'])) {
            $data['clave'] = bcrypt($data['clave']);
        } else {
            unset($data['clave']); // No actualizar la contraseña si no se proporciona
        }

        $empleado->update($data);
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy($id_empleado)
    {
        // Verificar si el usuario está autenticado
        if (!session('empleado_id')) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }

        $empleado = Empleado::findOrFail($id_empleado);
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }

    /*===================================================================================================== */

    public function login()
    {
        return view('admin.Auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|max:50',
            'clave' => 'required|max:100',
        ]);

        // Buscar el empleado por 'login'
        $empleado = Empleado::where('login', $request->login)->first();

        // Verificar si el empleado existe y la contraseña es correcta
        if ($empleado && Hash::check($request->clave, $empleado->clave)) {
            // Almacenar información del empleado en la sesión
            $request->session()->put('empleado_id', $empleado->id_empleado);
            $request->session()->put('empleado_login', $empleado->login);
            $request->session()->put('empleado_rol', $empleado->rol);

            return redirect()->route('admin.index')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors([
            'login' => 'Las credenciales no coinciden.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        // Limpiar la sesión
        $request->session()->forget(['empleado_id', 'empleado_login', 'empleado_rol']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Sesión cerrada exitosamente.');
    }
}
