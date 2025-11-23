<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Poliza;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class SiniestroController extends Controller
{
    // 1. Listado de siniestros
    public function index()
    {
        $siniestros = Siniestro::with(['poliza.vehiculo', 'poliza.seguro', 'empleado'])
            ->latest()
            ->paginate(15);

        return view('admin.siniestros.index', compact('siniestros'));
    }

    // 2. Formulario para buscar póliza
    public function crear()
    {
        // Lista de empleados para el select
        $empleados = \App\Models\Empleado::all();
        return view('admin.siniestros.create', compact('empleados'));
    }

    // 3. Buscar póliza por placa o número
    public function buscarPoliza(Request $request)
    {
        if ($request->filled('poliza_directa')) {
            $poliza = Poliza::with(['vehiculo.cliente', 'vehiculo.modelo.marca', 'seguro'])
                ->where('id_poliza', $request->poliza_directa)
                ->where('estado', 'vigente')
                ->firstOrFail();

            $empleados = \App\Models\Empleado::all();
            return view('admin.siniestros.registrar', compact('poliza', 'empleados'));
        }
        $request->validate([
            'busqueda' => 'required|string|max:50'
        ]);

        $busqueda = strtoupper(trim($request->busqueda));

        // Buscamos TODAS las pólizas vigentes del vehículo (SOAT y/o Automotriz)
        $polizas = Poliza::with(['vehiculo.cliente', 'vehiculo.modelo.marca', 'seguro'])
            ->where('estado', 'vigente')
            ->whereHas('vehiculo', function ($q) use ($busqueda) {
                $q->where('placa', $busqueda);
            })
            ->orWhere('numero_poliza', 'LIKE', "%{$busqueda}%")
            ->get();

        if ($polizas->isEmpty()) {
            return back()->with('error', 'No se encontró ninguna póliza vigente con esos datos.');
        }

        $empleados = \App\Models\Empleado::all();

        // Si solo tiene una → va directo al formulario
        if ($polizas->count() === 1) {
            $poliza = $polizas->first();
            return view('admin.siniestros.registrar', compact('poliza', 'empleados'));
        }

        // Si tiene más de una (SOAT + Automotriz) → le mostramos para que elija
        return view('admin.siniestros.seleccionar', compact('polizas', 'empleados'));
    }

    // 4. Guardar el siniestro
    public function store(Request $request)
    {
        $request->validate([
            'id_poliza'        => 'required|exists:polizas,id_poliza',
            'fecha'            => 'required|date',
            'hora'             => 'required',
            'ubicacion'        => 'required|string|max:200',
            'descripcion'      => 'required|string|max:450',
            'monto_estimado'   => 'required|numeric|min:0',
            'estado'           => 'required|in:registrado,en_proceso,aprobado,rechazado,cerrado',
            'id_empleado'      => 'required|exists:empleados,id_empleado',
        ]);

        Siniestro::create($request->all());

        return redirect()
            ->route('siniestros.index')
            ->with('success', 'Siniestro registrado correctamente.');
    }

    // 5. Ver detalle
    public function show($id)
    {
        $siniestro = Siniestro::with(['poliza.vehiculo.cliente', 'poliza.vehiculo.modelo.marca', 'poliza.seguro', 'empleado'])
            ->findOrFail($id);

        return view('admin.siniestros.show', compact('siniestro'));
    }

    public function registrar(Request $request)
    {
        $polizaId = $request->query('poliza_id');

        if (!$polizaId) {
            return redirect()->route('siniestros.crear')
                ->with('error', 'No se seleccionó ninguna póliza.');
        }

        $poliza = Poliza::with(['vehiculo.cliente', 'vehiculo.modelo.marca', 'seguro'])
            ->where('id_poliza', $polizaId)
            ->where('estado', 'vigente')
            ->firstOrFail();

        $empleados = \App\Models\Empleado::all();

        return view('admin.siniestros.registrar', compact('poliza', 'empleados'));
    }
}
