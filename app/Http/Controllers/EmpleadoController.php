<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmpleadoController extends Controller
{
    // ESTA ES TU FUNCIÓN PRINCIPAL DEL DASHBOARD (la que ya tenías)
    public function index()
    {
        if (!session('empleado_id')) {
            return redirect()->route('admin.login');
        }

        $hoy = Carbon::today();

        // === ESTADÍSTICAS PRINCIPALES ===
        $stats = [
            'soat_mes' => DB::table('ventas')
                ->join('seguros', 'ventas.id_seguro', '=', 'seguros.id_seguro')
                ->join('tipos_seguro', 'seguros.id_tipo', '=', 'tipos_seguro.id_tipo')
                ->where('tipos_seguro.nombre', 'SOAT')
                ->whereMonth('ventas.fecha', now()->month)
                ->whereYear('ventas.fecha', now()->year)
                ->count(),

            'automotriz_mes' => DB::table('ventas')
                ->join('seguros', 'ventas.id_seguro', '=', 'seguros.id_seguro')
                ->join('tipos_seguro', 'seguros.id_tipo', '=', 'tipos_seguro.id_tipo')
                ->where('tipos_seguro.nombre', 'AUTOMOTRIZ')
                ->whereMonth('ventas.fecha', now()->month)
                ->whereYear('ventas.fecha', now()->year)
                ->count(),

            'ingresos_mes' => DB::table('ventas')
                ->whereMonth('ventas.fecha', now()->month)
                ->whereYear('ventas.fecha', now()->year)
                ->sum('monto_total'),

            'ventas_hoy' => DB::table('ventas')
                ->whereDate('ventas.fecha', $hoy)
                ->count(),
        ];

        // === DETALLES PARA LOS MODALES (todo en una sola consulta eficiente) ===
        $detalles = [
            'soat' => DB::table('ventas')
                ->join('seguros', 'ventas.id_seguro', '=', 'seguros.id_seguro')
                ->join('tipos_seguro', 'seguros.id_tipo', '=', 'tipos_seguro.id_tipo')
                ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
                ->where('tipos_seguro.nombre', 'SOAT')
                ->whereMonth('ventas.fecha', now()->month)
                ->select('clientes.nombre', 'clientes.ci', 'ventas.monto_total', 'ventas.fecha')
                ->latest('ventas.fecha')
                ->take(20)
                ->get(),

            'automotriz' => DB::table('ventas')
                ->join('seguros', 'ventas.id_seguro', '=', 'seguros.id_seguro')
                ->join('tipos_seguro', 'seguros.id_tipo', '=', 'tipos_seguro.id_tipo')
                ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
                ->where('tipos_seguro.nombre', 'AUTOMOTRIZ')
                ->whereMonth('ventas.fecha', now()->month)
                ->select('clientes.nombre', 'clientes.ci', 'ventas.monto_total', 'ventas.fecha')
                ->latest('ventas.fecha')
                ->take(20)
                ->get(),

            'hoy' => DB::table('ventas')
                ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
                ->join('seguros', 'ventas.id_seguro', '=', 'seguros.id_seguro')
                ->join('tipos_seguro', 'seguros.id_tipo', '=', 'tipos_seguro.id_tipo')
                ->whereDate('ventas.fecha', $hoy)
                ->select('clientes.nombre', 'clientes.ci', 'ventas.monto_total', 'ventas.fecha', 'tipos_seguro.nombre as tipo_seguro')
                ->latest('ventas.fecha')
                ->get(),

            'ingresos' => DB::table('ventas')
                ->whereMonth('ventas.fecha', now()->month)
                ->whereYear('ventas.fecha', now()->year)
                ->selectRaw('DATE(fecha) as fecha, COUNT(*) as cantidad, SUM(monto_total) as total')
                ->groupBy('fecha')
                ->orderBy('fecha')
                ->get(),
        ];

        return view('admin.index', compact('stats', 'detalles'));
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
            'rol' => 'required|max:1000',
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
            'rol' => 'required|max:1000',
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
