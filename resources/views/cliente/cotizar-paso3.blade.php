<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizar SOAT - Paso 3 - Aseguradora Pankej</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">
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

        /* HEADER EXACTO DE TU HOME */
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
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
            color: white;
        }

        /* STEPPER - EXACTO PASO 1 */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .step-container {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            min-height: 100vh;
            padding-top: 2rem;
        }

        .step-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 20px 20px 0 0;
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
        }

        /* BOTÓN GENERAR - VISIBLE Y GRANDE */
        .btn-generar {
            background: linear-gradient(45deg, var(--accent-color), #ef4444);
            border: none;
            border-radius: 50px;
            padding: 18px 50px;
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
            transition: all 0.3s ease;
        }

        .btn-generar:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(245, 158, 11, 0.6);
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

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .toggle-section {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 2px solid var(--success-color);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: center;
        }

        .form-check-input:checked {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .form-check-label {
            font-weight: 600;
            color: var(--success-color);
            font-size: 1.1rem;
        }

        footer {
            background: var(--dark-color);
            color: white;
        }
    </style>
</head>

<body>
    <!-- HEADER EXACTO DE TU HOME -->
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
                            <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link active" href="/cotizar">Cotizar</a></li>
                            <li class="nav-item"><a class="nav-link" href="#precios">Precios</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contacto">Contáctanos</a></li>
                            <li class="nav-item">
                                <a class="btn btn-primary-custom btn-sm ms-2" href="{{ route('register.cliente') }}">
                                    <i class="fas fa-user-shield me-1"></i>Registrarme
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- PASO 3 - EXACTO ESTILO PASO 1 -->
    <section class="step-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- STEPPER - EXACTO PASO 1 -->
                    <div class="step-header py-4">
                        <div class="text-center">
                            <div><i class="fas fa-calculator me-2"></i>Cotizador SOAT</div>
                            <div class="d-flex justify-content-center gap-3 mt-2">
                                <span class="step-number completed">1</span>
                                <span class="step-number completed">2</span>
                                <span class="step-number active">3</span>
                            </div>
                        </div>
                    </div>

                    <div class="step-card p-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-volver" onclick="history.back()">
                                <i class="fas fa-arrow-left me-2"></i>VOLVER
                            </button>
                            <h4 class="mb-0"><i class="fas fa-car me-2"></i>Completar Datos del Vehículo</h4>
                        </div>

                        <form method="POST" action="/cotizar/paso4">
                            @csrf

                            {{-- DATOS CLIENTE --}}
                            @foreach ($datosCliente as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach

                            {{-- DATOS PASO 2 --}}
                            <input type="hidden" name="tipo_vehiculo" value="{{ $tipo_vehiculo }}">
                            <input type="hidden" name="marca" value="{{ $marca }}">
                            <input type="hidden" name="anio" value="{{ $anio }}">
                            <input type="hidden" name="procedencia" value="{{ $procedencia }}">
                            <input type="hidden" name="paquete_km" value="{{ $paquete_km }}">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Modelo</label>
                                    <input type="text" name="modelo" class="form-control" placeholder="Ej: 123wer"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Placa</label>
                                    <input type="text" name="placa" class="form-control" placeholder="Ej: 345gt"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Color</label>
                                    <input type="text" name="color" class="form-control" placeholder="Ej: rojo"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">N° Pasajeros</label>
                                    <input type="number" name="pasajeros" class="form-control" min="1"
                                        max="10" placeholder="Ej: 2" required>
                                </div>
                            </div>

                            <!-- TOGGLE */
                            <div class="toggle-section">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="bloquear">
                                    <label class="form-check-label" for="bloquear">
                                        <i class="fas fa-lock me-2"></i>Bloquear campos autocompletados
                                    </label>
                                </div>
                            </div>

                            <!-- BOTÓN GENERAR - VISIBLE Y GRANDE -->
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-generar">
                                    <i class="fas fa-file-pdf me-2"></i>GENERAR COTIZACIÓN PDF
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Aseguradora Pankej. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
