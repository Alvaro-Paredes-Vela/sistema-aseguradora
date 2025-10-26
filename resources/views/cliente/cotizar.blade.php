<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizar SOAT - Paso 1 - Aseguradora Pankej</title>
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

        /* STEPPER */
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

        .btn-continuar {
            background: var(--success-color);
            border-radius: 50px;
            padding: 15px 40px;
            font-weight: 600;
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

    <!-- PASO 1 -->
    <section class="step-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="step-header py-4">
                        <div class="text-center">
                            <div><i class="fas fa-calculator me-2"></i>Cotizador SOAT</div>
                            <div class="d-flex justify-content-center gap-3 mt-2">
                                <span class="step-number active">1</span>
                                <span class="step-number">2</span>
                                <span class="step-number">3</span>
                            </div>
                        </div>
                    </div>
                    <div class="step-card p-5">
                        <h4 class="mb-4"><i class="fas fa-user me-2"></i>Datos del Cliente</h4>
                        <form method="POST" action="{{ route('cotizar.paso2') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-8"><label class="form-label fw-bold">Nombres y
                                        Apellidos</label><input type="text" name="nombres" class="form-control"
                                        required></div>
                                <div class="col-md-4"><label class="form-label fw-bold">Género</label><select
                                        name="genero" class="form-select" required>
                                        <option value="">Seleccionar</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select></div>
                                <div class="col-md-4"><label class="form-label fw-bold">Fecha Nacimiento</label><input
                                        type="date" name="fecha_nacimiento" class="form-control" required></div>
                                <div class="col-md-4"><label class="form-label fw-bold">Cédula</label><input
                                        type="text" name="ci" class="form-control" required></div>
                                <div class="col-md-4"><label class="form-label fw-bold">Estado Civil</label><select
                                        name="estado_civil" class="form-select" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Soltero">Soltero</option>
                                        <option value="Casado">Casado</option>
                                    </select></div>
                                <div class="col-md-8"><label class="form-label fw-bold">Ciudad</label><select
                                        name="ciudad" class="form-select" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Santa Cruz">Santa Cruz</option>
                                        <option value="La Paz">La Paz</option>
                                        <option value="Cochabamba">Cochabamba</option>
                                    </select></div>
                                <div class="col-12"><label class="form-label fw-bold">Dirección</label><input
                                        type="text" name="direccion" class="form-control" required></div>
                                <div class="col-md-6"><label class="form-label fw-bold">Correo</label><input
                                        type="email" name="email" class="form-control" required></div>
                                <div class="col-md-6"><label class="form-label fw-bold">Celular</label><input
                                        type="tel" name="celular" class="form-control" required></div>
                            </div>
                            <div class="text-end mt-4"><button type="submit" class="btn btn-continuar text-white"><i
                                        class="fas fa-arrow-right me-2"></i>CONTINUAR</button></div>
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
