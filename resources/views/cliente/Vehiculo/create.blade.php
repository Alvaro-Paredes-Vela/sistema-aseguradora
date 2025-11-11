<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo - SOAT 2025</title>
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

        .btn-secondary {
            border-radius: 50px;
            padding: 0.7rem 1.5rem;
        }

        .precio-previo {
            background: linear-gradient(135deg, #fff8e1, #fef3c7);
            border: 2px dashed var(--accent);
            border-radius: 16px;
            padding: 1.2rem;
            text-align: center;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
            margin: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
            display: none;
        }

        .precio-previo i {
            color: var(--accent);
            margin-right: 8px;
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

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header-title">REGISTRAR VEHÍCULO - SOAT</div>

    <div class="container">
        <div class="form-container">
            @if (session('success'))
                <div class="alert alert-success mx-3 mt-3"><i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}</div>
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
                <form action="{{ route('soat.vehiculo.store') }}" method="POST" id="form-registro">
                    @csrf

                    <!-- VEHÍCULO -->
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-car me-2"></i> Tipo de Vehículo *</label>
                        <select name="tipo_vehiculo" id="tipo-vehiculo" class="form-select" required
                            onchange="filtrarMarcas(); calcularPrecio();">
                            <option value="">Seleccionar tipo</option>
                            <option value="motocicleta" {{ old('tipo_vehiculo') == 'motocicleta' ? 'selected' : '' }}>
                                Motocicleta</option>
                            <option value="automovil" {{ old('tipo_vehiculo') == 'automovil' ? 'selected' : '' }}>
                                Automóvil</option>
                            <option value="jeep" {{ old('tipo_vehiculo') == 'jeep' ? 'selected' : '' }}>Jeep</option>
                            <option value="camioneta" {{ old('tipo_vehiculo') == 'camioneta' ? 'selected' : '' }}>
                                Camioneta</option>
                            <option value="vagoneta" {{ old('tipo_vehiculo') == 'vagoneta' ? 'selected' : '' }}>Vagoneta
                            </option>
                            <option value="microbus" {{ old('tipo_vehiculo') == 'microbus' ? 'selected' : '' }}>Microbús
                            </option>
                            <option value="colectivo" {{ old('tipo_vehiculo') == 'colectivo' ? 'selected' : '' }}>
                                Colectivo</option>
                            <option value="omnibus_flota"
                                {{ old('tipo_vehiculo') == 'omnibus_flota' ? 'selected' : '' }}>Ómnibus / Flota
                            </option>
                            <option value="tracto_camion"
                                {{ old('tipo_vehiculo') == 'tracto_camion' ? 'selected' : '' }}>Tracto Camión</option>
                            <option value="minibus_8" {{ old('tipo_vehiculo') == 'minibus_8' ? 'selected' : '' }}>
                                Minibús (8 ocupantes)</option>
                            <option value="minibus_11" {{ old('tipo_vehiculo') == 'minibus_11' ? 'selected' : '' }}>
                                Minibús (11 ocupantes)</option>
                            <option value="minibus_15" {{ old('tipo_vehiculo') == 'minibus_15' ? 'selected' : '' }}>
                                Minibús (15 ocupantes)</option>
                            <option value="camion_3" {{ old('tipo_vehiculo') == 'camion_3' ? 'selected' : '' }}>Camión
                                (3 ocupantes)</option>
                            <option value="camion_18" {{ old('tipo_vehiculo') == 'camion_18' ? 'selected' : '' }}>
                                Camión (18 ocupantes)</option>
                            <option value="camion_25" {{ old('tipo_vehiculo') == 'camion_25' ? 'selected' : '' }}>
                                Camión (25 ocupantes)</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Placa *</label>
                            <input type="text" name="placa" class="form-control text-uppercase"
                                value="{{ strtoupper(request()->get('placa') ?? old('placa')) }}"
                                placeholder="Ej: 5842BNY" required maxlength="15">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Año de Fabricación *</label>
                            <input type="number" name="anio_fabricacion" class="form-control"
                                value="{{ old('anio_fabricacion') }}" min="1900" max="{{ date('Y') }}"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Marca *</label>
                            <select name="id_marca" id="marca-select" class="form-select" required
                                onchange="cargarModelos(); calcularPrecio();">
                                <option value="">Seleccione tipo primero</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Modelo *</label>
                            <select name="id_modelo" id="modelo-select" class="form-select" required>
                                <option value="">Seleccione marca primero</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Uso del Vehículo *</label>
                            <select name="uso_vehiculo" id="uso-vehiculo" class="form-select" required
                                onchange="calcularPrecio();">
                                <option value="particular"
                                    {{ old('uso_vehiculo', 'particular') == 'particular' ? 'selected' : '' }}>
                                    Particular</option>
                                <option value="publico" {{ old('uso_vehiculo') == 'publico' ? 'selected' : '' }}>
                                    Público (Taxi, transporte)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Departamento *</label>
                            <select name="region" id="region" class="form-select" required
                                onchange="calcularPrecio();">
                                <option value="santa_cruz" {{ old('region') == 'santa_cruz' ? 'selected' : '' }}>Santa
                                    Cruz</option>
                                <option value="la_paz" {{ old('region') == 'la_paz' ? 'selected' : '' }}>La Paz
                                </option>
                                <option value="cochabamba" {{ old('region') == 'cochabamba' ? 'selected' : '' }}>
                                    Cochabamba</option>
                                <option value="oruro" {{ old('region') == 'oruro' ? 'selected' : '' }}>Oruro</option>
                                <option value="potosi" {{ old('region') == 'potosi' ? 'selected' : '' }}>Potosí
                                </option>
                                <option value="beni" {{ old('region') == 'beni' ? 'selected' : '' }}>Beni</option>
                                <option value="pando" {{ old('region') == 'pando' ? 'selected' : '' }}>Pando</option>
                                <option value="chuquisaca" {{ old('region') == 'chuquisaca' ? 'selected' : '' }}>
                                    Chuquisaca</option>
                                <option value="tarija" {{ old('region') == 'tarija' ? 'selected' : '' }}>Tarija
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="precio-previo" id="precio-previo">
                        <i class="fas fa-coins"></i> Precio SOAT: Bs <span id="monto">0</span>
                    </div>

                    <hr class="my-4">

                    <!-- PROPIETARIO -->
                    <h6 class="section-title"><i class="fas fa-user me-2"></i> Datos del Propietario</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nombre *</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}"
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Paterno *</label>
                            <input type="text" name="paterno" class="form-control" value="{{ old('paterno') }}"
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Materno</label>
                            <input type="text" name="materno" class="form-control" value="{{ old('materno') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Cédula de Identidad *</label>
                            <input type="text" name="CI" class="form-control" value="{{ old('CI') }}"
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Teléfono *</label>
                            <input type="text" name="telefono" class="form-control"
                                value="{{ old('telefono') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Correo Electrónico *</label>
                            <input type="email" name="correo" class="form-control" value="{{ old('correo') }}"
                                required placeholder="ejemplo@dominio.com">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('soat.buscar.form') }}" class="btn btn-secondary me-2"><i
                                class="fas fa-arrow-left me-2"></i> Cancelar</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i> Guardar y
                            Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const marcas = @json($marcas);
        const modelos = @json($modelos);

        const marcasPorTipo = {
            motocicleta: [15, 16, 17, 18, 19, 20, 21, 28, 29, 30, 31, 32], // Honda=15, Yamaha=16...
            automovil: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            jeep: [1, 2, 5, 8],
            camioneta: [2, 5, 8, 9, 10, 11],
            vagoneta: [1, 2, 3, 4, 5, 6],
            microbus: [26, 27],
            colectivo: [26, 27],
            omnibus_flota: [26, 27],
            tracto_camion: [22, 23, 24, 25],
            minibus_8: [26, 27],
            minibus_11: [26, 27],
            minibus_15: [26, 27],
            camion_3: [22, 23, 24, 25],
            camion_18: [22, 23, 24, 25],
            camion_25: [22, 23, 24, 25]
        };

        const preciosSOAT = {
            /* TU OBJETO COMPLETO */
            motocicleta: {
                particular: 200,
                publico: 155
            },
            automovil: {
                particular: 90,
                publico: 120
            },
            jeep: {
                particular: 110,
                publico: 75
            },
            camioneta: {
                particular: 140,
                publico: 190
            },
            vagoneta: {
                particular: 90,
                publico: 125
            },
            microbus: {
                particular: 460,
                publico: 315
            },
            colectivo: {
                particular: 595,
                publico: 335
            },
            omnibus_flota: {
                particular: 2630,
                publico: 3700
            },
            tracto_camion: {
                particular: 290,
                publico: 185
            },
            minibus_8: {
                particular: 140,
                publico: 125
            },
            minibus_11: {
                particular: 200,
                publico: 190
            },
            minibus_15: {
                particular: 330,
                publico: 245
            },
            camion_3: {
                particular: 330,
                publico: 195
            },
            camion_18: {
                particular: 1020,
                publico: 975
            },
            camion_25: {
                particular: 1310,
                publico: 1260
            }
        };

        function ajustarPorRegion(precio, region) {
            if (region === 'santa_cruz') return precio * 0.98;
            if (['la_paz', 'cochabamba'].includes(region)) return precio * 1.1;
            return precio;
        }

        function filtrarMarcas() {
            const tipo = document.getElementById('tipo-vehiculo').value;
            const marcaSelect = document.getElementById('marca-select');
            const modeloSelect = document.getElementById('modelo-select');
            marcaSelect.innerHTML = '<option value="">Seleccione marca</option>';
            modeloSelect.innerHTML = '<option value="">Seleccione modelo</option>';

            if (!tipo || !marcasPorTipo[tipo]) return;

            marcasPorTipo[tipo].forEach(id => {
                const marca = marcas.find(m => m.id_marca == id);
                if (marca) {
                    const opt = document.createElement('option');
                    opt.value = marca.id_marca;
                    opt.textContent = marca.nombre;
                    if ('{{ old('id_marca') }}' == marca.id_marca) opt.selected = true;
                    marcaSelect.appendChild(opt);
                }
            });
            cargarModelos();
            calcularPrecio();
        }

        function cargarModelos() {
            const marcaId = document.getElementById('marca-select').value;
            const modeloSelect = document.getElementById('modelo-select');
            modeloSelect.innerHTML = '<option value="">Seleccione modelo</option>';
            if (!marcaId) return;

            modelos.filter(m => m.id_marca == marcaId).forEach(m => {
                const opt = document.createElement('option');
                opt.value = m.id_modelo;
                opt.textContent = m.nombre;
                if ('{{ old('id_modelo') }}' == m.id_modelo) opt.selected = true;
                modeloSelect.appendChild(opt);
            });
        }

        function calcularPrecio() {
            const tipo = document.getElementById('tipo-vehiculo').value || '';
            const uso = document.getElementById('uso-vehiculo').value || 'particular';
            const region = document.getElementById('region').value || 'santa_cruz';
            const div = document.getElementById('precio-previo');
            const span = document.getElementById('monto');

            if (!tipo) {
                div.style.display = 'none';
                return;
            }

            let precio = preciosSOAT[tipo]?.[uso] || 0;
            precio = ajustarPorRegion(precio, region);
            span.textContent = Math.round(precio).toLocaleString('es-BO');
            div.style.display = 'block';
        }

        function togglePassword() {
            const pass = document.getElementById('password');
            const eye = document.getElementById('eye');
            if (pass.type === 'password') {
                pass.type = 'text';
                eye.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pass.type = 'password';
                eye.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // PLACA AUTO
            const placaInput = document.querySelector('input[name="placa"]');
            placaInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });

            // RESTAURAR
            const tipo = '{{ old('tipo_vehiculo') }}';
            const marca = '{{ old('id_marca') }}';
            if (tipo) {
                document.getElementById('tipo-vehiculo').value = tipo;
                filtrarMarcas();
                if (marca) {
                    setTimeout(() => {
                        document.getElementById('marca-select').value = marca;
                        cargarModelos();
                    }, 100);
                }
            }
            calcularPrecio();

            // JS CONFIRM PASS
            document.getElementById('form-registro').addEventListener('submit', e => {
                if (document.querySelector('[name=password]').value !== document.querySelector(
                        '[name=password_confirmation]').value) {
                    e.preventDefault();
                    alert('Las contraseñas no coinciden');
                }
            });
        });
    </script>
</body>

</html>
