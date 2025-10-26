<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.home', compact('clientes'));
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
            'correo' => 'nullable|email|max:100',
            'nombres' => 'nullable|max:50',
            'paterno' => 'nullable|max:50',
            'materno' => 'nullable|max:50',
            'direccion' => 'nullable|max:100',
            'nro_telefono' => 'nullable|max:15',
            'estado' => 'nullable|boolean',
        ]);

        $cliente = new \App\Models\Cliente();
        $cliente->login = $request->login;
        $cliente->password = Hash::make($request->password); // Encriptar la contraseña
        $cliente->correo = $request->correo;
        $cliente->nombres = $request->nombres;
        $cliente->paterno = $request->paterno;
        $cliente->materno = $request->materno;
        $cliente->direccion = $request->direccion;
        $cliente->nro_telefono = $request->nro_telefono;
        $cliente->estado = $request->estado ?? true;
        $cliente->save();

        return redirect()->route('login')->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    public function show($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('cliente.show', compact('cliente'));
    }
    /*
    public function edit($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('cliente.edit', compact('cliente'));
    }
*/
    public function update(Request $request, $id_cliente)
    {
        $request->validate([
            'login' => 'required|unique:clientes,login,' . $id_cliente . ',id_cliente|max:50',
            'password' => 'required|max:100',
            'correo' => 'nullable|email|max:100',
            'nombres' => 'nullable|max:50',
            'paterno' => 'nullable|max:50',
            'materno' => 'nullable|max:50',
            'direccion' => 'nullable|max:100',
            'nro_telefono' => 'nullable|max:15',
            'estado' => 'boolean',
        ]);

        $cliente = Cliente::findOrFail($id_cliente);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }

    // Método para mostrar el formulario de login del cliente
    public function login()
    {
        return view('cliente.Auth.login');
    }

    // Método para autenticar al cliente
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|max:50',
            'password' => 'required|max:255',
        ]);

        // Buscar el cliente en la base de datos
        $cliente = Cliente::where('login', $credentials['login'])->first();

        // Verificar si el cliente existe y la contraseña es correcta
        if ($cliente && Hash::check($credentials['password'], $cliente->password)) {
            // Iniciar sesión manualmente
            Session::put('cliente_id', $cliente->id_cliente);
            Session::put('cliente_nombre', $cliente->nombres ?? 'Cliente');

            // Redirigir al home
            return redirect()->route('home')->with('success', 'Inicio de sesión exitoso.');
        }

        // Credenciales incorrectas
        return back()->withErrors([
            'login' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        // Cerrar sesión manualmente
        Session::forget('cliente_id');
        Session::forget('cliente_nombre');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Sesión cerrada exitosamente.');
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
            'nombres' => 'required',
            // Otros campos...
        ]);

        $cliente = Cliente::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'nombres' => $request->nombres,
            // Otros campos...
        ]);

        Session::put('cliente_id', $cliente->id_cliente);
        Session::put('cliente_nombre', $cliente->nombres);
        return redirect()->route('home')->with('success', 'Registro exitoso. ¡Bienvenido!');
    }

    public function edit($id)
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('home')->with('error', 'Debes iniciar sesión para editar tus datos.');
        }
        $cliente = Cliente::findOrFail($id);
        return view('cliente.editarDatos', compact('cliente'));
    }

    public function verifyVigencia()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('home')->with('error', 'Debes iniciar sesión para verificar la vigencia.');
        }
        return view('cliente.VerificarVigencia');
    }

    public function showComprobante()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('home')->with('error', 'Debes iniciar sesión para acceder al comprobante.');
        }
        return view('cliente.auth.loginComprobante');
    }
}
