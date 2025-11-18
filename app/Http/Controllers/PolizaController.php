<?php

namespace App\Http\Controllers;

use App\Models\Poliza;
use App\Models\Vehiculo;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolizaController extends Controller
{

    /*========================================ACTUALIZAR POLIZA=============================================*/

    // 1. MOSTRAR FORMULARIO DE BÚSQUEDA
    public function buscarPolizaForm()
    {
        return view('cliente.Comprar-Soat.actualizar-poliza');
    }

    // 2. BUSCAR PÓLIZA POR PLACA
    public function buscarPoliza(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:15'
        ]);

        $placa = strtoupper($request->placa);
        $vehiculo = Vehiculo::where('placa', $placa)->first();

        // 2. ¿TIENE SEGURO AUTOMOTRIZ VIGENTE?
        $tieneAutomotriz = DB::table('polizas')
            ->join('seguros', 'polizas.id_seguro', '=', 'seguros.id_seguro')
            ->where('polizas.id_vehiculo', $vehiculo->id_vehiculo)
            ->where('seguros.nombre', 'like', '%Automotriz%')
            ->where('polizas.estado', 'vigente')
            ->whereDate('polizas.fecha_vencimiento', '>=', now())
            ->exists();

        // SI TIENE AUTOMOTRIZ → LO MANDO AL HOME CON MENSAJE
        if ($tieneAutomotriz) {
            return redirect()->route('home') // o route('automotriz.dashboard') si quieres
                ->with(
                    'info',
                    'Tu vehículo ya cuenta con Seguro Automotriz vigente. ' .
                        'Sin embargo, recuerda que el SOAT es obligatorio por ley. ' .
                        '¡Adquiérelo ahora para circular legalmente!'
                );
        }

        if (!$vehiculo) {
            return back()->with('error', 'Vehículo no encontrado con placa: ' . $placa);
        }

        $poliza = $vehiculo->polizas()
            ->where('estado', 'vigente')
            ->where('fecha_vencimiento', '>', now())
            ->first();

        if (!$poliza) {
            return back()->with('error', 'No existe SOAT vigente para esta placa.');
        }

        $marcas = \App\Models\Marca::all();
        $modelos = \App\Models\Modelo::all();

        return view('cliente.Comprar-Soat.actualizar-poliza', [
            'poliza' => $poliza,
            'vehiculo' => $vehiculo,
            'cliente' => $vehiculo->cliente,
            'marcas' => $marcas,
            'modelos' => $modelos,
        ]);
    }

    // 3. ACTUALIZAR PÓLIZA
    public function actualizarPoliza(Request $request, $id)
    {
        $poliza = Poliza::findOrFail($id);
        $vehiculo = $poliza->vehiculo;
        $cliente = $vehiculo->cliente;

        $request->validate([
            'id_marca' => 'required|exists:marcas,id_marca',
            'id_modelo' => 'required|exists:modelos,id_modelo',
            'anio_fabricacion' => 'required|integer|min:1900|max:' . date('Y'),
            'placa' => 'nullable|string|max:15|unique:vehiculos,placa,' . $vehiculo->id_vehiculo . ',id_vehiculo',
            'nro_chasis' => 'nullable|string|max:50',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
            'direccion' => 'required|string|max:255',
        ]);

        // ACTUALIZAR VEHÍCULO
        $vehiculo->update([
            'id_marca' => $request->id_marca,
            'id_modelo' => $request->id_modelo,
            'anio_fabricacion' => $request->anio_fabricacion,
            'placa' => strtoupper($request->placa ?? $vehiculo->placa),
            'nro_chasis' => $request->nro_chasis,
        ]);

        // ACTUALIZAR CLIENTE
        $cliente->update([
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
        ]);

        return back()->with('success', 'Póliza actualizada correctamente.');
    }
}
