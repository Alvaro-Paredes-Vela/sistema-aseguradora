<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VehiculoController extends Controller
{
    // 1. FORM (público para nuevos usuarios)
    public function create()
    {
        if (Marca::count() === 0) {
            $this->cargarDatosVehiculosBolivia();
        }

        $marcas = Marca::all();
        $modelos = Modelo::all();
        $placa = session('placa_buscada');  // De SOAT buscar

        return view('cliente.Vehiculo.create', compact('marcas', 'modelos', 'placa'));
    }

    // 2. STORE SEGURO + LOGIN AUTO
    public function store(Request $request)
    {
        if (Marca::count() === 0) {
            $this->cargarDatosVehiculosBolivia();
        }

        $request->validate([
            // VEHÍCULO
            'placa' => 'required|string|max:15|unique:vehiculos,placa',
            'tipo_vehiculo' => 'required|in:motocicleta,automovil,jeep,camioneta,vagoneta,microbus,colectivo,omnibus_flota,tracto_camion,minibus_8,minibus_11,minibus_15,camion_3,camion_18,camion_25',
            'uso_vehiculo' => 'required|in:particular,publico',
            'region' => 'required|in:santa_cruz,la_paz,cochabamba,oruro,potosi,beni,pando,chuquisaca,tarija',
            'id_marca' => 'required|exists:marcas,id_marca',
            'id_modelo' => 'required|exists:modelos,id_modelo',
            'anio_fabricacion' => 'required|integer|min:1900|max:' . date('Y'),
            'nro_chasis' => 'nullable|string|max:50',
            // CLIENTE
            'CI' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'paterno' => 'required|string|max:100',
            'materno' => 'nullable|string|max:100',

            'correo' => 'nullable|email',
            'telefono' => 'required|string|max:15',
            'login' => 'nullable|string|unique:clientes,login|max:50',
            'password' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, &$clienteId) {
            // EN TRANSACCIÓN
            $dataCliente = [
                'CI' => $request->CI,
                'nombre' => $request->nombre,
                'paterno' => $request->paterno,
                'materno' => $request->materno ?? null,
                'telefono' => $request->telefono,
                'direccion' => 'No especificada',
                'foto' => null,
                'estado' => true,
                'correo' => null,  // DEFAULT NULL
                'login' => null,
                'password' => null,
            ];

            if ($request->filled('correo')) {
                $dataCliente['correo'] = $request->correo;
            }
            if ($request->filled('login')) {
                $dataCliente['login'] = $request->login;
            }
            if ($request->filled('password')) {
                $dataCliente['password'] = Hash::make($request->password);
            }

            $cliente = Cliente::create($dataCliente);


            // 2. VEHÍCULO
            Vehiculo::create([
                'placa' => strtoupper($request->placa),
                'id_cliente' => $cliente->id_cliente,
                'id_marca' => $request->id_marca,
                'id_modelo' => $request->id_modelo,
                'anio_fabricacion' => $request->anio_fabricacion,
                'nro_chasis' => $request->nro_chasis,
                'tipo_vehiculo' => $request->tipo_vehiculo,
                'uso_vehiculo' => $request->uso_vehiculo,
                'region' => $request->region,
                'estado' => 'activo',
            ]);

            $clienteId = $cliente->id_cliente;
        });

        // 3. LOGIN AUTOMÁTICO
        //Session::put('cliente_id', $clienteId);
        //Session::put('cliente_nombre', $request->nombre);

        // 4. REDIRECT CORRECTO A SOAT PAGO
        return redirect()->route('soat.pago.form', strtoupper($request->placa))
            ->with('success', '¡Registrado! Completa datos para SOAT.');
    }

    // === AGREGA ESTE MÉTODO AL FINAL DE LA CLASE ===
    private function calcularPrecioSOAT($tipo, $uso, $region)
    {
        $precios = [
            'motocicleta'   => ['particular' => 200, 'publico' => 155],
            'automovil'     => ['particular' => 90,  'publico' => 120],
            'jeep'          => ['particular' => 110, 'publico' => 75],
            'camioneta'     => ['particular' => 140, 'publico' => 190],
            'vagoneta'      => ['particular' => 90,  'publico' => 125],
            'microbus'      => ['particular' => 460, 'publico' => 315],
            'colectivo'     => ['particular' => 595, 'publico' => 335],
            'omnibus_flota' => ['particular' => 2630, 'publico' => 3700],
            'tracto_camion' => ['particular' => 290, 'publico' => 185],
            'minibus_8'     => ['particular' => 140, 'publico' => 125],
            'minibus_11'    => ['particular' => 200, 'publico' => 190],
            'minibus_15'    => ['particular' => 330, 'publico' => 245],
            'camion_3'      => ['particular' => 330, 'publico' => 195],
            'camion_18'     => ['particular' => 1020, 'publico' => 975],
            'camion_25'     => ['particular' => 1310, 'publico' => 1260],
        ];

        $base = $precios[$tipo][$uso] ?? 0;

        return match ($region) {
            'santa_cruz' => $base * 0.98,
            'la_paz', 'cochabamba' => $base * 1.1,
            default => $base,
        };
    }

    /**
     * Carga marcas y modelos de Bolivia (incluyendo motos de Montero)
     * Usa IDs reales generados por la base de datos
     */
    private function cargarDatosVehiculosBolivia()
    {
        DB::transaction(function () {
            // === 1. CREAR MARCAS ===
            $marcasNombres = [
                'Suzuki',
                'Toyota',
                'Nissan',
                'Hyundai',
                'Chevrolet',
                'Kia',
                'Changan',
                'JAC',
                'Ford',
                'Mazda',
                'Renault',
                'Volkswagen',
                'Chery',
                'Mercedes-Benz',
                'Honda',
                'Yamaha',
                'UM',
                'Motomel',
                'Hero',
                'TVS',
                'AKT',
                'Foton',
                'Sinotruk (Howo)',
                'Volvo Trucks',
                'UD Trucks',
                'King Long (Buses)',
                'Yutong (Buses)',
                'Montero',
                'Daimo',
                'Kawasaki',
                'Suzuki Motos',
                'Kanda'
            ];

            $ids = [];

            foreach ($marcasNombres as $nombre) {
                $marca = Marca::create(['nombre' => $nombre]);
                $clave = strtolower(str_replace([' ', '(', ')'], '_', $nombre));
                $ids[$clave] = $marca->id_marca;
            }

            // === 2. MODELOS POR MARCA ===
            $modelosData = [
                // --- AUTOS Y SUV ---
                ['id_marca' => $ids['suzuki'], 'nombre' => 'Swift (Automóvil)'],
                ['id_marca' => $ids['suzuki'], 'nombre' => 'Vitara (SUV)'],
                ['id_marca' => $ids['suzuki'], 'nombre' => 'Grand Vitara (SUV)'],
                ['id_marca' => $ids['suzuki'], 'nombre' => 'Jimny (4x4)'],
                ['id_marca' => $ids['suzuki'], 'nombre' => 'XL7 (Minivan)'],
                ['id_marca' => $ids['suzuki'], 'nombre' => 'Fronx (SUV)'],
                ['id_marca' => $ids['suzuki'], 'nombre' => 'Ertiga (Minivan)'],
                ['id_marca' => $ids['suzuki'], 'nombre' => 'S-Cross (SUV)'],

                ['id_marca' => $ids['toyota'], 'nombre' => 'Hilux (Camioneta)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'Corolla (Automóvil)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'RAV4 (SUV)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'Agya (Automóvil)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'Rush (SUV)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'Fortuner (SUV 4x4)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'Land Cruiser (4x4)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'Corolla Cross (SUV)'],
                ['id_marca' => $ids['toyota'], 'nombre' => 'Hiace (Minivan Comercial)'],

                ['id_marca' => $ids['nissan'], 'nombre' => 'March (Automóvil)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'Versa (Automóvil)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'Sentra (Automóvil)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'Kicks (SUV)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'Qashqai (SUV)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'X-Trail (SUV)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'Frontier (Camioneta)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'Patrol (4x4)'],
                ['id_marca' => $ids['nissan'], 'nombre' => 'Urvan (Minivan Comercial)'],

                ['id_marca' => $ids['hyundai'], 'nombre' => 'Grand i10 (Automóvil)'],
                ['id_marca' => $ids['hyundai'], 'nombre' => 'i20 (Automóvil)'],
                ['id_marca' => $ids['hyundai'], 'nombre' => 'Elantra (Automóvil)'],
                ['id_marca' => $ids['hyundai'], 'nombre' => 'Tucson (SUV)'],
                ['id_marca' => $ids['hyundai'], 'nombre' => 'Creta (SUV)'],
                ['id_marca' => $ids['hyundai'], 'nombre' => 'Santa Fe (SUV)'],

                ['id_marca' => $ids['chevrolet'], 'nombre' => 'Onix (Automóvil)'],
                ['id_marca' => $ids['chevrolet'], 'nombre' => 'Sail (Automóvil)'],
                ['id_marca' => $ids['chevrolet'], 'nombre' => 'Tracker (SUV)'],
                ['id_marca' => $ids['chevrolet'], 'nombre' => 'Captiva (SUV)'],
                ['id_marca' => $ids['chevrolet'], 'nombre' => 'S10 (Camioneta)'],
                ['id_marca' => $ids['chevrolet'], 'nombre' => 'Montana (Camioneta)'],
                ['id_marca' => $ids['chevrolet'], 'nombre' => 'D-Max (Camioneta)'],

                ['id_marca' => $ids['kia'], 'nombre' => 'Picanto (Automóvil)'],
                ['id_marca' => $ids['kia'], 'nombre' => 'Rio (Automóvil)'],
                ['id_marca' => $ids['kia'], 'nombre' => 'Sportage (SUV)'],
                ['id_marca' => $ids['kia'], 'nombre' => 'Seltos (SUV)'],
                ['id_marca' => $ids['kia'], 'nombre' => 'Sorento (SUV)'],
                ['id_marca' => $ids['kia'], 'nombre' => 'Carnival (Minivan)'],

                // --- MOTOCICLETAS ---
                ['id_marca' => $ids['honda'], 'nombre' => 'Wave 110 (Scooter)'],
                ['id_marca' => $ids['honda'], 'nombre' => 'CB190R (Deportiva)'],
                ['id_marca' => $ids['honda'], 'nombre' => 'XRE 190 (Trail)'],
                ['id_marca' => $ids['honda'], 'nombre' => 'Tornado 250 (Adventure)'],
                ['id_marca' => $ids['honda'], 'nombre' => 'XR 300 (Off-road)'],

                ['id_marca' => $ids['yamaha'], 'nombre' => 'YZF-R3 (Deportiva)'],
                ['id_marca' => $ids['yamaha'], 'nombre' => 'Fazer 150 (Naked)'],
                ['id_marca' => $ids['yamaha'], 'nombre' => 'XTZ 125 (Trail)'],
                ['id_marca' => $ids['yamaha'], 'nombre' => 'MT-03 (Naked)'],
                ['id_marca' => $ids['yamaha'], 'nombre' => 'YZ 450F (Off-road)'],

                ['id_marca' => $ids['um'], 'nombre' => 'Renegade Commando 200 (Classic)'],
                ['id_marca' => $ids['um'], 'nombre' => 'Xtreet 250 (Scooter)'],
                ['id_marca' => $ids['um'], 'nombre' => 'Alaska 200 (Adventure)'],
                ['id_marca' => $ids['um'], 'nombre' => 'Rebel 250 (Cruiser)'],

                ['id_marca' => $ids['motomel'], 'nombre' => 'Skua 110 (Scooter)'],
                ['id_marca' => $ids['motomel'], 'nombre' => 'V100 (Scooter)'],
                ['id_marca' => $ids['motomel'], 'nombre' => 'Flash 110 (Urbana)'],
                ['id_marca' => $ids['motomel'], 'nombre' => 'GT 200 (Classic)'],

                ['id_marca' => $ids['hero'], 'nombre' => 'Ignitor 125 (Commuter)'],
                ['id_marca' => $ids['hero'], 'nombre' => 'Glamour 125 (Urbana)'],
                ['id_marca' => $ids['hero'], 'nombre' => 'Xtreme 160 (Deportiva)'],

                ['id_marca' => $ids['tvs'], 'nombre' => 'Apache RTR 160 (Deportiva)'],
                ['id_marca' => $ids['tvs'], 'nombre' => 'Radeon 125 (Commuter)'],
                ['id_marca' => $ids['tvs'], 'nombre' => 'Jupiter 110 (Scooter)'],

                ['id_marca' => $ids['akt'], 'nombre' => 'TT 125 (Urbana)'],
                ['id_marca' => $ids['akt'], 'nombre' => 'NK 150 (Naked)'],
                ['id_marca' => $ids['akt'], 'nombre' => 'Dyno 200 (Adventure)'],

                // --- MOTOS DE MONTERO ---
                ['id_marca' => $ids['montero'], 'nombre' => 'Ninja 250cc (Deportiva)'],
                ['id_marca' => $ids['montero'], 'nombre' => 'Cross Gan 200cc (Off-road)'],
                ['id_marca' => $ids['montero'], 'nombre' => 'Ducati 250cc (Clásica)'],
                ['id_marca' => $ids['montero'], 'nombre' => 'MT200 (Naked)'],
                ['id_marca' => $ids['montero'], 'nombre' => 'Ninja Repsol 250cc (Deportiva)'],

                ['id_marca' => $ids['daimo'], 'nombre' => 'CGL 150cc (Pavera)'],
                ['id_marca' => $ids['daimo'], 'nombre' => 'Trueno 200cc (Deportiva)'],

                ['id_marca' => $ids['kawasaki'], 'nombre' => 'Ninja 250 (Deportiva)'],
                ['id_marca' => $ids['kawasaki'], 'nombre' => 'Z250 (Naked)'],
                ['id_marca' => $ids['kawasaki'], 'nombre' => 'KLX 150 (Off-road)'],

                ['id_marca' => $ids['suzuki_motos'], 'nombre' => 'Gixxer 150 (Naked)'],
                ['id_marca' => $ids['suzuki_motos'], 'nombre' => 'Hayabusa 250 (Deportiva)'],

                ['id_marca' => $ids['kanda'], 'nombre' => 'Puma 150cc (Urbana)'],
                ['id_marca' => $ids['kanda'], 'nombre' => 'Fenix 200cc (Deportiva)'],

                // --- CAMIONES Y BUSES ---
                ['id_marca' => $ids['foton'], 'nombre' => 'Auman 6 (Camión Mediano)'],
                ['id_marca' => $ids['foton'], 'nombre' => 'Auman 9 (Camión Pesado)'],
                ['id_marca' => $ids['foton'], 'nombre' => 'View BS (Bus Urbano)'],
                ['id_marca' => $ids['foton'], 'nombre' => 'Toano (Minibus)'],

                ['id_marca' => $ids['sinotruk__howo_'], 'nombre' => 'Howo A7 (Camión Pesado)'],
                ['id_marca' => $ids['sinotruk__howo_'], 'nombre' => 'Howo 13 (Volquete)'],
                ['id_marca' => $ids['sinotruk__howo_'], 'nombre' => 'Howo Bus (Bus Interprovincial)'],

                ['id_marca' => $ids['volvo_trucks'], 'nombre' => 'FH 460 (Camión Pesado)'],
                ['id_marca' => $ids['volvo_trucks'], 'nombre' => 'FMX (Volquete 4x4)'],

                ['id_marca' => $ids['ud_trucks'], 'nombre' => 'Kazetani G (Camión Mediano)'],
                ['id_marca' => $ids['ud_trucks'], 'nombre' => 'Quon (Camión Pesado)'],

                ['id_marca' => $ids['king_long__buses_'], 'nombre' => 'XMQ6608 (Bus Interdepartamental)'],
                ['id_marca' => $ids['king_long__buses_'], 'nombre' => 'XMQ6809 (Bus Turístico)'],

                ['id_marca' => $ids['yutong__buses_'], 'nombre' => 'ZK6108 (Bus Urbano)'],
                ['id_marca' => $ids['yutong__buses_'], 'nombre' => 'ZK6127 (Bus Interprovincial)'],
            ];

            foreach ($modelosData as $modelo) {
                Modelo::create($modelo);
            }
        });
    }
}
