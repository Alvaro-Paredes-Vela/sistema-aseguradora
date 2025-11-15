<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Póliza SOAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a8a;
            --accent: #f59e0b;
            --dark: #1f2937;
            --light: #f8fafc;
            --success: #10b981;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .header-title {
            background: var(--primary);
            color: white;
            padding: 1.2rem 0;
            text-align: center;
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 1.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-container {
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            margin: 2rem auto;
            max-width: 800px;
            overflow: hidden;
        }

        .form-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1.5px solid #cbd5e1;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
        }

        .btn-success {
            background: var(--accent);
            border: none;
            border-radius: 50px;
            padding: 0.7rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-success:hover {
            background: #e68a00;
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 50px;
            padding: 0.7rem 2rem;
        }

        .section-title {
            color: var(--primary);
            font-weight: 700;
            margin: 1.5rem 0 1rem;
            font-size: 1.1rem;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 0.3rem;
            display: inline-block;
        }

        .alert {
            border-radius: 12px;
        }

        .info-box {
            background: #f0f9ff;
            border-left: 4px solid var(--primary);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
        }

        .search-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="header-title">ACTUALIZAR PÓLIZA SOAT</div>

    <div class="container">
        <div class="form-container">
            @if (session('success'))
                <div class="alert alert-success mx-3 mt-3">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mx-3 mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mx-3 mt-3">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i> Corrige los errores:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-body">

                <!-- BUSCAR POR PLACA -->
                <div class="search-box">
                    <h5 class="mb-3"><i class="fas fa-search me-2"></i> Buscar Póliza por Placa</h5>
                    <form action="{{ route('soat.poliza.buscar') }}" method="GET"
                        class="row g-3 justify-content-center">
                        @csrf
                        <div class="col-md-6">
                            <input type="text" name="placa" class="form-control text-center text-uppercase"
                                placeholder="Ej: 5842BNY" required maxlength="15" value="{{ old('placa') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- SI ENCUENTRA PÓLIZA → MUESTRA FORMULARIO -->
                @if (isset($poliza))
                    <div class="info-box">
                        <p class="mb-1"><strong>Póliza:</strong> #{{ $poliza->numero_poliza }}</p>
                        <p class="mb-1"><strong>Placa:</strong> {{ $vehiculo->placa }}</p>
                        <p class="mb-0"><strong>Vigente hasta:</strong>
                            {{ \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y') }}
                        </p>
                    </div>

                    <form action="{{ route('soat.poliza.actualizar', $poliza->id_poliza) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- VEHÍCULO -->
                        <h6 class="section-title">Datos del Vehículo</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Marca *</label>
                                <select name="id_marca" class="form-select" required onchange="cargarModelos()">
                                    <option value="">Seleccionar</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id_marca }}"
                                            {{ old('id_marca', $vehiculo->id_marca) == $marca->id_marca ? 'selected' : '' }}>
                                            {{ $marca->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Modelo *</label>
                                <select name="id_modelo" id="modelo-select" class="form-select" required>
                                    <option value="">Seleccione marca</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Año *</label>
                                <input type="number" name="anio_fabricacion" class="form-control"
                                    value="{{ old('anio_fabricacion', $vehiculo->anio_fabricacion) }}" min="1900"
                                    max="{{ date('Y') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Placa</label>
                                <input type="text" name="placa" class="form-control text-uppercase"
                                    value="{{ old('placa', $vehiculo->placa) }}" maxlength="15">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Chasis</label>
                            <input type="text" name="nro_chasis" class="form-control"
                                value="{{ old('nro_chasis', $vehiculo->nro_chasis) }}">
                        </div>

                        <hr class="my-4">

                        <!-- PROPIETARIO -->
                        <h6 class="section-title">Datos del Propietario</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teléfono *</label>
                                <input type="text" name="telefono" class="form-control"
                                    value="{{ old('telefono', $cliente->telefono) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Correo *</label>
                                <input type="email" name="correo" class="form-control"
                                    value="{{ old('correo', $cliente->correo) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección *</label>
                            <input type="text" name="direccion" class="form-control"
                                value="{{ old('direccion', $cliente->direccion ?? '') }}" required>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary me-2">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Actualizar Póliza
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        const modelos = @json($modelos ?? []);

        function cargarModelos() {
            const marcaId = document.querySelector('[name="id_marca"]').value;
            const select = document.getElementById('modelo-select');
            select.innerHTML = '<option value="">Seleccione modelo</option>';

            if (!marcaId) return;

            modelos
                .filter(m => m.id_marca == marcaId)
                .forEach(m => {
                    const opt = document.createElement('option');
                    opt.value = m.id_modelo;
                    opt.textContent = m.nombre;
                    @if (isset($vehiculo))
                        if ('{{ old('id_modelo', $vehiculo->id_modelo) }}' == m.id_modelo) {
                            opt.selected = true;
                        }
                    @endif
                    select.appendChild(opt);
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const placaInput = document.querySelector('input[name="placa"]');
            if (placaInput) {
                placaInput.addEventListener('input', function() {
                    this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                });
            }
            @if (isset($poliza))
                cargarModelos();
            @endif
        });
    </script>
</body>

</html>
