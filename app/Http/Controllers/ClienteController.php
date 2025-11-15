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
        // Verifica si el cliente está logueado
        if (!Session::has('cliente_id')) {
            return redirect()->route('cliente.login')->with('error', 'Inicia sesión');
        }

        $cliente = \App\Models\Cliente::with('vehiculos')->find(Session::get('cliente_id'));
        return view('cliente.home', compact('cliente'));
    }

    // === VISTAS PÚBLICAS ===
    public function loginForm()
    {
        if (Session::has('cliente_id')) {
            return redirect()->route('cliente.dashboard');
        }
        return view('cliente.auth.login');
    }

    public function registerForm()
    {
        if (Session::has('cliente_id')) {
            return redirect()->route('cliente.dashboard');
        }
        return view('cliente.auth.register');
    }

    // === AUTENTICACIÓN ===
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:50',
            'password' => 'required|string',
        ]);

        $cliente = Cliente::where('login', $request->login)->first();

        if ($cliente && Hash::check($request->password, $cliente->password)) {
            Session::put('cliente_id', $cliente->id_cliente);
            Session::put('cliente_nombre', $cliente->nombre);
            return redirect()->route('cliente.dashboard')->with('success', '¡Bienvenido de nuevo!');
        }

        return back()->withErrors(['login' => 'Credenciales incorrectas.'])->withInput();
    }

    public function logout(Request $request)
    {
        Session::forget(['cliente_id', 'cliente_nombre']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome')->with('success', 'Sesión cerrada.');
    }

    // === REGISTRO ===
    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|string|unique:clientes,login|max:50',
            'password' => 'required|max:50|',  // confirmed necesita password_confirmation en form
            'correo' => 'required|email|unique:clientes,correo|max:255',
            'nombre' => 'required|string|max:100',
            'paterno' => 'required|string|max:100',
            'materno' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->hasFile('foto') ? $request->file('foto')->store('fotos/clientes', 'public') : null;

        $cliente = Cliente::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'correo' => $request->correo,
            'nombre' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'foto' => $path,
            'estado' => true,  // o 1 si es boolean
        ]);

        // Login automático post-registro
        Session::put('cliente_id', $cliente->id_cliente);
        Session::put('cliente_nombre', $cliente->nombre);

        return redirect()->route('cliente.login')->with('success', '¡Cuenta creada y sesión iniciada!');
    }

    // === DASHBOARD (solo propio) ===
    public function dashboard()
    {
        if (!$this->authCliente()) return $this->authCliente();  // Redirige si no auth

        $cliente = Cliente::with(['vehiculos'])->findOrFail(Session::get('cliente_id'));
        return view('welcome', compact('cliente'));
    }

    // === PERFIL ===
    public function edit()
    {
        if (!$this->authCliente()) return $this->authCliente();

        $cliente = Cliente::findOrFail(Session::get('cliente_id'));
        return view('cliente.mi-perfil', compact('cliente'));
    }

    public function update(Request $request)
    {
        if (!$this->authCliente()) return $this->authCliente();

        $cliente = Cliente::findOrFail(Session::get('cliente_id'));

        $request->validate([
            'nombre' => 'required|string|max:100',
            'paterno' => 'required|string|max:100',
            'materno' => 'required|string|max:100',
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


        return back()->with('success', '¡Perfil actualizado!');
    }

    public function destroy(Request $request)
    {
        if (!$this->authCliente()) return $this->authCliente();

        $cliente = Cliente::findOrFail(Session::get('cliente_id'));
        if ($cliente->foto) Storage::disk('public')->delete($cliente->foto);
        $cliente->delete();

        Session::forget(['cliente_id', 'cliente_nombre']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', '¡Cuenta eliminada!');
    }

    // === OTRAS VISTAS ===
    public function vigencia()
    {
        if (!$this->authCliente()) return $this->authCliente();
        return view('cliente.vigencia');
    }

    public function comprobante()
    {
        if (!$this->authCliente()) return $this->authCliente();
        return view('cliente.comprobante');
    }

    // === AUTH MANUAL (privado) ===
    private function authCliente()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('cliente.login')->with('error', 'Inicia sesión para continuar.');
        }
        return true;  // OK
    }

    public function soatDashboard()
    {
        $auth = $this->authCliente();
        if ($auth !== true) return $auth;  // redirige si no está autenticado

        $cliente = Cliente::with(['vehiculos'])->findOrFail(Session::get('cliente_id'));
        return view('cliente.home', compact('cliente'));
    }


    public function automotriz()
    {
        if (!$this->authCliente()) return $this->authCliente();

        return view('cliente.AutoMotrizHome');  // Tu vista automotriz.blade.php
    }

    public function cotizarForm()
    {
        if (!$this->authCliente()) return $this->authCliente();

        // Futuro: formulario cotización
        return view('cliente.cotizar');  // Crea vista simple
    }

    // ... vigencia(), comprobante() igual ...
}
