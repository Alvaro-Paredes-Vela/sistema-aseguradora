<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago SOAT - {{ $vehiculo->placa }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            max-width: 750px;
            margin: 0 auto;
        }

        .card-header {
            background: #1e3a8a;
            color: white;
            padding: 1.8rem;
            text-align: center;
            font-weight: 700;
            font-size: 1.4rem;
            border-radius: 20px 20px 0 0;
        }

        .precio {
            background: #fff8e1;
            border: 2px dashed #f59e0b;
            border-radius: 18px;
            padding: 1.8rem;
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e3a8a;
            margin: 2rem 0;
        }

        .btn-pagar {
            background: #10b981;
            border: none;
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .btn-pagar:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .form-label {
            font-weight: 600;
            color: #1e3a8a;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Pago SOAT - {{ $vehiculo->placa }}
            </div>
            <div class="card-body p-5">

                <!-- MENSAJES DE ÉXITO/ERROR -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Errores:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-6"><strong>Propietario:</strong> {{ $vehiculo->cliente->nombre }}
                        {{ $vehiculo->cliente->paterno }}</div>
                    <div class="col-md-6"><strong>Tipo:</strong>
                        {{ ucwords(str_replace('_', ' ', $vehiculo->tipo_vehiculo)) }}</div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6"><strong>Uso:</strong> {{ ucfirst($vehiculo->uso_vehiculo) }}</div>
                    <div class="col-md-6"><strong>Departamento:</strong> {{ ucfirst($vehiculo->region) }}</div>
                </div>

                <div class="precio">
                    <i class="fas fa-coins text-warning"></i> Precio SOAT: Bs
                    <strong>{{ number_format($precio) }}</strong>
                </div>

                <form action="{{ route('soat.pago.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="placa" value="{{ $vehiculo->placa }}">

                    <h5 class="mt-5 mb-4 text-primary"><i class="fas fa-car"></i> Completa los datos del vehículo</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Color</label>
                            <input type="text" name="color" class="form-control"
                                value="{{ old('color', $vehiculo->color) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nro. Chasis</label>
                            <input type="text" name="nro_chasis" class="form-control"
                                value="{{ old('nro_chasis', $vehiculo->nro_chasis) }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Nro. Motor</label>
                            <input type="text" name="nro_motor" class="form-control"
                                value="{{ old('nro_motor', $vehiculo->nro_motor) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cilindrada (cc)</label>
                            <input type="number" name="cilindrada" class="form-control"
                                value="{{ old('cilindrada', $vehiculo->cilindrada) }}" min="50" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Tipo de Combustible</label>
                            <select name="tipo_combustible" class="form-select" required>
                                <option value="">Seleccionar</option>
                                <option value="gasolina"
                                    {{ old('tipo_combustible', $vehiculo->tipo_combustible) == 'gasolina' ? 'selected' : '' }}>
                                    Gasolina</option>
                                <option value="diesel"
                                    {{ old('tipo_combustible', $vehiculo->tipo_combustible) == 'diesel' ? 'selected' : '' }}>
                                    Diesel</option>
                                <option value="gnv"
                                    {{ old('tipo_combustible', $vehiculo->tipo_combustible) == 'gnv' ? 'selected' : '' }}>
                                    GNV</option>
                                <option value="electrico"
                                    {{ old('tipo_combustible', $vehiculo->tipo_combustible) == 'electrico' ? 'selected' : '' }}>
                                    Eléctrico</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kilometraje</label>
                            <input type="number" name="kilometraje" class="form-control"
                                value="{{ old('kilometraje', $vehiculo->kilometraje) }}" min="0" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Valor Comercial (Bs)</label>
                        <input type="number" name="valor_comercial" class="form-control"
                            value="{{ old('valor_comercial', $vehiculo->valor_comercial) }}" min="1000"
                            step="100" required>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-pagar">
                            <i class="fas fa-qrcode"></i> Pagar SOAT - Bs {{ number_format($precio) }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
