<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function index()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        $clientes = Cliente::all();
        return view('cliente.home', compact('clientes'));
    }

    public function automotriz()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
        $clientes = Cliente::all();
        return view('cliente.AutoMotrizHome');
    }

    public function create()
    {
        return view('cliente.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|unique:clientes|max:50',
            'password' => 'required|max:100',
            'correo' => 'required|email|max:255|unique:clientes',
            'nombre' => 'required|string|max:255',
            'paterno' => 'required|string|max:255',
            'materno' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cliente = new Cliente();
        $cliente->login = $request->login;
        $cliente->password = Hash::make($request->password);
        $cliente->correo = $request->correo;
        $cliente->nombre = $request->nombre;
        $cliente->paterno = $request->paterno;
        $cliente->materno = $request->materno;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
            $cliente->foto = $path;
        }

        $cliente->save();

        Session::put('cliente_id', $cliente->id_cliente);
        Session::put('cliente_nombre', $cliente->nombre);
        return redirect()->route('welcome')->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    public function show($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('cliente.show', compact('cliente'));
    }

    public function edit($id)
    {
        if (!Session::has('cliente_id') || Session::get('cliente_id') != $id) {
            return redirect()->route('login')->with('error', 'No tienes permiso para editar este perfil.');
        }
        $cliente = Cliente::findOrFail($id);
        return view('cliente.mi-perfil', compact('cliente'));
    }

    public function update(Request $request, $id_cliente)
    {
        if (!Session::has('cliente_id') || Session::get('cliente_id') != $id_cliente) {
            return redirect()->route('login')->with('error', 'No tienes permiso para actualizar este perfil.');
        }

        $cliente = Cliente::findOrFail($id_cliente);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'paterno' => 'required|string|max:255',
            'materno' => 'required|string|max:255',
            'correo' => ['required', 'email', 'max:255', Rule::unique('clientes')->ignore($cliente->id_cliente, 'id_cliente')],
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($cliente->foto) {
                Storage::disk('public')->delete($cliente->foto);
            }
            $path = $request->file('foto')->store('fotos', 'public');
            $cliente->foto = $path;
        }

        $cliente->nombre = $request->nombre;
        $cliente->paterno = $request->paterno;
        $cliente->materno = $request->materno;
        $cliente->correo = $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;

        try {
            $cliente->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el perfil: ' . $e->getMessage())->withInput();
        }

        Session::put('cliente_nombre', $cliente->nombre);
        return redirect()->route('clientes.edit', $id_cliente)->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy($id_cliente)
    {
        if (!Session::has('cliente_id') || Session::get('cliente_id') != $id_cliente) {
            return redirect()->route('login')->with('error', 'No tienes permiso para eliminar esta cuenta.');
        }

        $cliente = Cliente::findOrFail($id_cliente);
        if ($cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
        }
        $cliente->delete();

        Session::forget(['cliente_id', 'cliente_nombre']);
        return redirect()->route('home')->with('success', 'Cuenta eliminada correctamente.');
    }

    public function login()
    {
        return view('cliente.Auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|max:50',
            'password' => 'required|max:255',
        ]);

        $cliente = Cliente::where('login', $credentials['login'])->first();

        if ($cliente && Hash::check($credentials['password'], $cliente->password)) {
            Session::put('cliente_id', $cliente->id_cliente);
            Session::put('cliente_nombre', $cliente->nombre ?? 'Cliente');
            return redirect()->route('welcome')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors([
            'login' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Session::forget(['cliente_id', 'cliente_nombre']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome')->with('success', 'Sesión cerrada exitosamente.');
    }

    public function showRegisterForm()
    {
        return view('cliente.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|unique:clientes|max:50',
            'password' => 'required|min:6',
            'nombre' => 'required|string|max:255',
            'paterno' => 'required|string|max:255',
            'materno' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:clientes',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cliente = Cliente::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'nombre' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'foto' => $request->hasFile('foto') ? $request->file('foto')->store('fotos', 'public') : null,
        ]);

        Session::put('cliente_id', $cliente->id_cliente);
        Session::put('cliente_nombre', $cliente->nombre);
        return redirect()->route('welcome')->with('success', 'Registro exitoso. ¡Bienvenido!');
    }

    public function verifyVigencia()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para verificar la vigencia.');
        }
        return view('cliente.VerificarVigencia');
    }

    public function showComprobante()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al comprobante.');
        }
        return view('cliente.auth.loginComprobante');
    }
}
