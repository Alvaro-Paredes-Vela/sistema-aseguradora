<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización Seguro Automotriz - Paso 2</title>

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

        /* HEADER */
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

        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
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

        .btn-continuar {
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

        .btn-continuar:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-volver {
            background: var(--gray-color);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .alert-precio {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: 2px solid var(--success-color);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--success-color);
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
            font-size: 0.9rem;
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
                            <li class="nav-item"><a class="nav-link" href="{{ route('contactar') }}">Contáctanos</a>
                            </li>
                            @if (Session::has('cliente_id'))
                                <li class="nav-item"><span class="nav-link">BIENVENIDO:
                                        {{ Session::get('cliente_nombre') }}</span></li>
                                <li class="nav-item"><a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('automotriz') }}"><i class="fas fa-sign-out-alt"></i>
                                        Volver a Inicio</a></li>
                            @else
                                <li class="nav-item"><a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('cliente.login') }}"><i class="fas fa-sign-in-alt"></i>
                                        Iniciar</a></li>
                                <li class="nav-item"><a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('register.cliente') }}"><i class="fas fa-user-shield"></i>
                                        Registrarme</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- PASO 2 -->
    <section class="step-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- STEPPER -->
                    <div class="step-header text-center">
                        <div><i class="fas fa-file-invoice-dollar me-2"></i>Cotización Seguro Automotriz</div>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <span class="step-number completed">1</span>
                            <span class="step-number active">2</span>
                            <span class="step-number">3</span>
                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="step-card">
                        <div class="text-center mb-4">
                            <h4><i class="fas fa-check-circle text-success me-2"></i>¡Cotización Lista!</h4>
                            <p class="text-muted">Revisa los detalles y confirma para continuar.</p>
                        </div>

                        <!-- RESUMEN DATOS -->
                        <div class="row text-center mb-4 g-3">
                            <div class="col-md-3">
                                <strong>Placa</strong><br>
                                <span class="text-primary fs-5">{{ strtoupper($datos['placa']) }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Valor Comercial</strong><br>
                                <span class="text-primary">Bs {{ number_format($datos['valor_comercial'], 2) }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Uso</strong><br>
                                <span class="text-primary">{{ ucfirst($datos['uso_vehiculo']) }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Región</strong><br>
                                <span class="text-primary">{{ ucwords(str_replace('_', ' ', $datos['region'])) }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Tipo de Seguro</strong><br>
                                <span class="badge bg-info fs-6">
                                    {{ $datos['tipo_cobertura'] == 'total' ? 'Seguro Total' : 'Seguro a Terceros' }}
                                </span>
                            </div>
                            <div class="col-md-6 text-end">
                                <strong>Prima Anual</strong><br>
                                <div class="alert-precio">
                                    Bs {{ number_format($prima) }}
                                </div>
                            </div>
                        </div>

                        <!-- BOTONES -->
                        <form action="{{ route('automotriz.confirmar-cotizacion') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="d-grid">
                                <button type="submit" class="btn btn-continuar">
                                    <i class="fas fa-check me-2"></i> Aceptar y Continuar
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('automotriz.registrar-vehiculo') }}" class="text-muted small">
                                <i class="fas fa-edit"></i> Modificar datos del vehículo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Aseguradora Pankej. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
