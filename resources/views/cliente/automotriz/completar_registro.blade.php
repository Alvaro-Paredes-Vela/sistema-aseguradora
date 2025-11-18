<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar Registro - Paso 3</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --gray-color: #6b7280;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 900;
            box-shadow: 0 8px 25px rgba(30, 58, 138, 0.3);
            position: relative;
            overflow: hidden;
        }

        .logo::before {
            content: 'P';
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            z-index: 1;
        }

        .logo::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .logo:hover::after {
            left: 100%;
        }

        .company-name {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-nav .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--secondary-color) !important;
            transform: translateY(-2px);
        }

        .btn-primary-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
            color: white;
        }

        /* STEPPER */
        .step-container {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            min-height: 100vh;
            padding-top: 2rem;
        }

        .step-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 1.5rem;
        }

        .step-number {
            background: var(--gray-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .step-number.active {
            background: var(--accent-color);
        }

        .step-number.completed {
            background: var(--success-color);
        }

        .step-card {
            background: white;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
        }

        .btn-finalizar {
            background: var(--success-color);
            border: none;
            border-radius: 50px;
            padding: 15px 40px;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        .btn-finalizar:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-control,
        .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
            font-size: 0.9rem;
        }

        .resumen-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--accent-color);
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="logo-container">
                        <div class="logo"></div>
                        <div>
                            <div class="company-name">Aseguradora Pankej</div>
                            <small class="text-muted">Seguros y Reaseguros Personales</small>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('automotriz') }}">Inicio</a></li>
                            @if (Session::has('cliente_id'))
                                <li class="nav-item"><span class="nav-link">BIENVENIDO:
                                        {{ Session::get('cliente_nombre') }}</span></li>
                                <li class="nav-item"><a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('automotriz') }}">Volver al inicio</a></li>
                            @else
                                <li class="nav-item"><a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('cliente.login') }}">Iniciar</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- PASO 3: COMPLETAR REGISTRO -->
    <section class="step-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- STEPPER -->
                    <div class="step-header text-center">
                        <div>Cotizador Seguro Automotriz</div>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <span class="step-number completed">1</span>
                            <span class="step-number completed">2</span>
                            <span class="step-number active">3</span>
                        </div>
                    </div>

                    <!-- FORMULARIO -->
                    <div class="step-card">
                        <h4 class="text-center mb-4">Completar Datos del Vehículo</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- RESUMEN COTIZACIÓN -->
                        <div class="resumen-card">
                            <h5 class="mb-3">Resumen de Cotización</h5>
                            <div class="row text-muted small">
                                <div class="col-md-6">
                                    <strong>Placa:</strong> {{ strtoupper($cotizacion['placa']) }}<br>
                                    <strong>Valor Comercial:</strong> Bs
                                    {{ number_format($cotizacion['valor_comercial'], 2) }}<br>
                                    <strong>Uso:</strong> {{ ucfirst($cotizacion['uso_vehiculo']) }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Región:</strong>
                                    {{ ucwords(str_replace('_', ' ', $cotizacion['region'])) }}<br>
                                    <strong>Tipo Seguro:</strong>
                                    {{ $cotizacion['tipo_cobertura'] === 'total' ? 'Seguro Total' : 'Seguro a Terceros' }}<br>
                                    <strong class="text-success">Prima Total: Bs
                                        {{ number_format($cotizacion['prima'], 2) }}</strong>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('automotriz.guardar-completo') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Año de Fabricación <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="anio_fabricacion" class="form-control" required
                                        min="1900" max="{{ date('Y') }}"
                                        value="{{ old('anio_fabricacion') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Color <span class="text-danger">*</span></label>
                                    <input type="text" name="color" class="form-control" required maxlength="50"
                                        value="{{ old('color') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nro. Chasis <span class="text-danger">*</span></label>
                                    <input type="text" name="nro_chasis" class="form-control text-uppercase" required
                                        maxlength="50" value="{{ old('nro_chasis') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nro. Motor <span class="text-danger">*</span></label>
                                    <input type="text" name="nro_motor" class="form-control text-uppercase" required
                                        maxlength="50" value="{{ old('nro_motor') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Cilindrada (cc)</label>
                                    <input type="number" name="cilindrada" class="form-control" min="50"
                                        value="{{ old('cilindrada') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RUAT</label>
                                    <input type="text" name="RUAT" class="form-control text-uppercase"
                                        maxlength="70" value="{{ old('RUAT') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tipo de Combustible <span
                                            class="text-danger">*</span></label>
                                    <select name="tipo_combustible" class="form-select" required>
                                        <option value="">Seleccionar</option>
                                        @foreach (['gasolina', 'diesel', 'gnv', 'electrico', 'hibrido'] as $comb)
                                            <option value="{{ $comb }}"
                                                {{ old('tipo_combustible') == $comb ? 'selected' : '' }}>
                                                {{ ucfirst($comb) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Kilometraje</label>
                                    <input type="number" name="kilometraje" class="form-control" min="0"
                                        value="{{ old('kilometraje') }}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Modelo del Vehículo <span
                                            class="text-danger">*</span></label>
                                    <select name="id_modelo" class="form-select" required>
                                        <option value="">Seleccionar modelo</option>
                                        @foreach ($modelos as $modelo)
                                            <option value="{{ $modelo->id_modelo }}"
                                                {{ old('id_modelo') == $modelo->id_modelo ? 'selected' : '' }}>
                                                {{ $modelo->marca->nombre }} {{ $modelo->nombre }}
                                                ({{ $modelo->anio }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-finalizar">
                                    Finalizar Registro y Proceder al Pago
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p>© 2025 Aseguradora Pankej. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
