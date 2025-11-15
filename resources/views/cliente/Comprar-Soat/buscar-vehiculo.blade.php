{{-- resources/views/cliente/Comprar-Soat/buscar.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Vehículo - SOAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 1rem;
        }

        .card-search {
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            max-width: 520px;
            margin: auto;
            overflow: hidden;
        }

        .card-header {
            background: #1e3a8a;
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary {
            background: #f59e0b;
            border: none;
            border-radius: 50px;
            padding: 0.7rem 2rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #e68a00;
        }

        .result {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.2rem;
            margin-top: 1rem;
        }

        .btn-success {
            background: #10b981;
            border: none;
            border-radius: 50px;
            width: 100%;
            padding: 0.8rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        .btn-warning {
            background: #f59e0b;
            border: none;
            border-radius: 50px;
            width: 100%;
            padding: 0.8rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        .alert-vigente {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border: 2px solid #10b981;
            color: #065f46;
            border-radius: 16px;
            padding: 1.2rem;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .alert-vigente i {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .btn-download {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 0.8rem;
        }

        .btn-download:hover {
            background: #059669;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-search">
            <div class="card-header">
                Buscar Vehículo por Placa
            </div>
            <div class="card-body">

                <!-- MENSAJE GENERAL -->
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- FORMULARIO DE BÚSQUEDA -->
                <form method="POST" action="{{ route('soat.buscar') }}" id="form-buscar">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Placa del Vehículo</label>
                        <input type="text" name="placa" class="form-control text-uppercase text-center fs-5"
                            value="{{ old('placa') }}" placeholder="Ej: 5842BNY" required maxlength="15" autofocus
                            oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Buscar
                        </button>
                    </div>
                </form>

                <!-- RESULTADO: VEHÍCULO ENCONTRADO -->
                @if (session('vehiculo'))
                    <div class="result mt-4">
                        <h6 class="text-success fw-bold">
                            Vehículo Encontrado
                        </h6>
                        <hr>
                        <p class="mb-1"><strong>Placa:</strong> {{ session('vehiculo')->placa }}</p>
                        <p class="mb-1"><strong>Propietario:</strong>
                            {{ trim(
                                collect([
                                    session('vehiculo')->cliente->nombre,
                                    session('vehiculo')->cliente->paterno,
                                    session('vehiculo')->cliente->materno,
                                ])->filter()->implode(' '),
                            ) }}
                        </p>
                        <p class="mb-1"><strong>Marca/Modelo:</strong>
                            {{ session('vehiculo')->marca->nombre ?? 'N/A' }} -
                            {{ session('vehiculo')->modelo->nombre ?? 'N/A' }}
                        </p>
                        <p class="mb-1"><strong>Tipo:</strong>
                            {{ ucwords(str_replace('_', ' ', session('vehiculo')->tipo_vehiculo)) }}
                        </p>
                        <p class="mb-3"><strong>Uso:</strong>
                            {{ ucfirst(session('vehiculo')->uso_vehiculo) }} -
                            {{ ucfirst(session('vehiculo')->region) }}
                        </p>

                        <!-- SOAT VIGENTE -->
                        @if (session('soat_vigente'))
                            <div class="alert alert-vigente">
                                <div><strong>SOAT VIGENTE</strong></div>
                                <div>Hasta el @php
                                    $fecha = \Carbon\Carbon::hasFormat(session('soat_vencimiento'), 'd/m/Y')
                                        ? \Carbon\Carbon::createFromFormat('d/m/Y', session('soat_vencimiento'))
                                        : now();
                                @endphp
                                    <strong>{{ $fecha->format('d/m/Y') }}</strong>
                                </div>
                                <a href="{{ route('soat.poliza.descargar', session('poliza_id')) }}"
                                    class="btn btn-download">
                                    Descargar Comprobante
                                </a>
                            </div>
                        @else
                            <a href="{{ route('soat.pago.form', session('vehiculo')->placa) }}"
                                class="btn btn-success">
                                Renovar SOAT
                            </a>
                        @endif
                    </div>
                @endif

                <!-- VEHÍCULO NO ENCONTRADO -->
                @if (session('error'))
                    <div class="alert alert-warning mt-4 text-center">
                        {{ session('error') }}
                        <hr>
                        <a href="{{ route('soat.vehiculo.create') }}?placa={{ urlencode(session('placa_buscada')) }}"
                            class="btn btn-warning">
                            Registrar Nuevo Vehículo
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // LIMPIAR SESIÓN AL CARGAR (excepto placa_buscada)
            const limpiarSesion = () => {
                fetch("{{ route('soat.limpiar.resultado') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });
            };

            // Limpiar al cargar página (evita resultados antiguos)
            limpiarSesion();

            // Limpiar placa_buscada después de usarla

        });
    </script>
</body>

</html>
