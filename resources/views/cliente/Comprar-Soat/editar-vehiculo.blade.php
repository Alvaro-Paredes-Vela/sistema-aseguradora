<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Vehículo - SOAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            max-width: 700px;
            margin: auto;
        }

        .card-header {
            background: #1e3a8a;
            color: white;
            border-radius: 20px 20px 0 0 !important;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center py-4">
                <h4 class="mb-0">Actualizar Datos del Vehículo</h4>
                <small>Placa: <strong>{{ $vehiculo->placa }}</strong></small>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('soat.vehiculo.actualizar', $vehiculo->placa) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Marca</label>
                            <select class="form-select" id="marca" required>
                                <option value="">Seleccionar marca</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id_marca }}"
                                        {{ $vehiculo->modelo?->id_marca == $marca->id_marca ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Modelo</label>
                            <select class="form-select" name="id_modelo" required>
                                <option value="">Primero selecciona marca</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id_modelo }}"
                                        {{ $vehiculo->id_modelo == $modelo->id_modelo ? 'selected' : '' }}>
                                        {{ $modelo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tipo de Vehículo</label>
                            <select class="form-select" name="tipo_vehiculo" required>
                                <option value="">Seleccionar tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo }}"
                                        {{ $vehiculo->tipo_vehiculo == $tipo ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $tipo)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Uso del Vehículo</label>
                            <select class="form-select" name="uso_vehiculo" required>
                                <option value="">Seleccionar uso</option>
                                @foreach ($usos as $uso)
                                    <option value="{{ $uso }}"
                                        {{ $vehiculo->uso_vehiculo == $uso ? 'selected' : '' }}>
                                        {{ ucfirst($uso) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Departamento</label>
                            <select class="form-select" name="region" required>
                                <option value="">Seleccionar departamento</option>
                                @foreach ($regiones as $region)
                                    <option value="{{ $region }}"
                                        {{ $vehiculo->region == $region ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $region)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Color</label>
                            <input type="text" class="form-control" name="color" value="{{ $vehiculo->color }}"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nro. Chasis</label>
                            <input type="text" class="form-control" name="nro_chasis"
                                value="{{ $vehiculo->nro_chasis }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nro. Motor</label>
                            <input type="text" class="form-control" name="nro_motor"
                                value="{{ $vehiculo->nro_motor }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Cilindrada (cc)</label>
                            <input type="number" class="form-control" name="cilindrada"
                                value="{{ $vehiculo->cilindrada }}" required min="50">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Combustible</label>
                            <select class="form-select" name="tipo_combustible" required>
                                <option value="gasolina"
                                    {{ $vehiculo->tipo_combustible == 'gasolina' ? 'selected' : '' }}>Gasolina</option>
                                <option value="diesel" {{ $vehiculo->tipo_combustible == 'diesel' ? 'selected' : '' }}>
                                    Diesel</option>
                                <option value="gnv" {{ $vehiculo->tipo_combustible == 'gnv' ? 'selected' : '' }}>GNV
                                </option>
                                <option value="electrico"
                                    {{ $vehiculo->tipo_combustible == 'electrico' ? 'selected' : '' }}>Eléctrico
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Kilometraje</label>
                            <input type="number" class="form-control" name="kilometraje"
                                value="{{ $vehiculo->kilometraje }}" required min="0">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Valor Comercial (Bs)</label>
                            <input type="number" step="0.01" class="form-control" name="valor_comercial"
                                value="{{ $vehiculo->valor_comercial }}" required min="1000">
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Guardar y Continuar al SOAT
                        </button>
                        <a href="{{ route('soat.buscar.form') }}" class="btn btn-secondary ms-3">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Cargar modelos cuando cambie la marca
        document.getElementById('marca').addEventListener('change', function() {
            const marcaId = this.value;
            const modeloSelect = document.querySelector('select[name="id_modelo"]');

            if (!marcaId) {
                modeloSelect.innerHTML = '<option value="">Primero selecciona marca</option>';
                return;
            }

            fetch(`/api/modelos-por-marca/${marcaId}`)
                .then(r => r.json())
                .then(data => {
                    modeloSelect.innerHTML = '<option value="">Seleccionar modelo</option>';
                    data.forEach(m => {
                        modeloSelect.innerHTML += `<option value="${m.id_modelo}">${m.nombre}</option>`;
                    });
                });
        });
    </script>
</body>

</html>
