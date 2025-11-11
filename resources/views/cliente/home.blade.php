<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAT - Aseguradora Pankej</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Header con logo */
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

        /* Hero Section */
        .hero-section {
            padding: 4rem 0;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .soat-explanation {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .soat-explanation h2 {
            color: var(--primary-color);
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        /* Secciones de servicios */
        .services-section {
            padding: 4rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .service-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
        }

        .service-card h3 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .service-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Botones */
        .btn-primary-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .logo {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .company-name {
                font-size: 1.3rem;
            }

            .service-card {
                margin: 1rem;
                padding: 1.5rem;
            }
        }

        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .service-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .service-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .service-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .service-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .service-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .service-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .service-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        .service-card:nth-child(7) {
            animation-delay: 0.7s;
        }

        .service-card:nth-child(8) {
            animation-delay: 0.8s;
        }
    </style>
</head>

<body>
    <!-- Header con logo -->
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="logo-container">
                        <div class="logo">
                            <!-- Logo animado de Pankej -->
                        </div>
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
                            <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#precios">Precios</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('contactar') }}">Contáctanos</a>
                            </li>
                            @if (Session::has('cliente_id'))
                                <li class="nav-item">
                                    <span class="nav-link">BIENVENIDO: {{ Session::get('cliente_nombre') }}</span>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom btn-sm ms-2" href="{{ route('cliente.logout') }}">
                                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom btn-sm ms-2" href="{{ route('cliente.login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('cliente.register') }}">
                                        <i class="fas fa-user-shield me-1"></i>Registrarme
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section" id="inicio">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">SOAT Pankej</h1>
                <p class="hero-subtitle">Tu seguridad en movimiento. El seguro obligatorio que protege tu tranquilidad.
                </p>
                <a href="#servicios" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-arrow-down me-2"></i>Explora Nuestros Servicios
                </a>
            </div>
        </div>
    </section>

    <!-- Explicación SOAT -->
    <section class="soat-explanation">
        <div class="container">
            <h2><i class="fas fa-shield-alt text-primary me-3"></i>¿Qué es el SOAT?</h2>
            <p class="lead text-center">
                Es el <strong>seguro obligatorio de accidentes de tránsito</strong> que todo vehículo debe tener, el
                cual ampara los gastos médicos, muerte e incapacidad total y permanente, en caso de un accidente de
                tránsito. Con Aseguradora Pankej, tu seguridad está garantizada.
            </p>
        </div>
    </section>

    <!-- Servicios -->
    <section class="services-section" id="servicios">
        <div class="container">
            <h2 class="text-center mb-5" style="color: white; font-family: 'Orbitron', sans-serif;">
                <i class="fas fa-car-side text-accent me-3"></i>Nuestros Servicios
            </h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3>Guía de Atención</h3>
                        <p>Guía completa para atención de siniestros con nuestro equipo especializado 24/7. Disponibles
                        </p>
                        <a href="{{ route('guia.siniestro') }}" class="btn btn-primary-custom mt-3">Ver Guía</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h3>Precios SOAT</h3>
                        <p>Consulta nuestros precios competitivos y planes personalizados por tipo de vehículo, uso y
                            departamento.</p>
                        <a href="{{ route('cliente.soat.precios') }}" class="btn btn-primary-custom mt-3">Precios</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Puntos de Venta</h3>
                        <p>Encuentra nuestros puntos de venta autorizados cerca de ti para mayor conveniencia.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Comprobante Digital</h3>
                        <p>Accede a tu comprobante SOAT y roseta digital de forma inmediata y segura.</p>
                        @if (Session::has('cliente_id'))
                            <a href="{{ route('login.comprobante') }}" class="btn btn-primary-custom mt-3">Acceder</a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-primary-custom mt-3 disabled"
                                onclick="alert('Debes iniciar sesión para acceder al comprobante.'); return false;">
                                Acceder
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h3>Modificar Datos</h3>
                        <p>Actualiza fácilmente la información de tu póliza cuando lo necesites en el momento.</p>
                        @if (Session::has('cliente_id'))
                            <a href="{{ route('cliente.perfil', Session::get('cliente_id')) }}"
                                class="btn btn-primary-custom mt-3">Editar</a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-primary-custom mt-3 disabled"
                                onclick="alert('Debes iniciar sesión para editar tus datos.'); return false;">
                                Editar
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Verificar Vigencia</h3>
                        <p>Consulta o verifica el estado de vigencia de tu SOAT en cualquier momento.</p>
                        @if (Session::has('cliente_id'))
                            <a href="{{ route('verificar.vigencia') }}"
                                class="btn btn-primary-custom mt-3">Verificar</a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-primary-custom mt-3 disabled"
                                onclick="alert('Debes iniciar sesión para verificar la vigencia.'); return false;">
                                Verificar
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Compra tu SOAT</h3>
                        <p>Adquiere tu SOAT en línea de forma rápida y segura con nuestros métodos de pago.</p>
                        <a href="{{ route('soat.buscar.form') }}" class="btn btn-primary-custom mt-3">Comprar</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Contáctanos</h3>
                        <p>Nuestro equipo de atención al cliente está listo para ayudarte 24/7.</p>
                        <a href="{{ route('contactar') }}" class="btn btn-primary-custom mt-3">Contactar</a>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div class="alert alert-danger text-center mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Aseguradora Pankej. Todos los derechos reservados. |
                <a href="#">Términos y Condiciones</a> |
                <a href="#">Política de Privacidad</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Smooth scrolling para navegación
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animación del logo
        const logo = document.querySelector('.logo');
        logo.addEventListener('mouseenter', function() {
            this.style.transform = 'rotate(360deg) scale(1.1)';
        });

        logo.addEventListener('mouseleave', function() {
            this.style.transform = 'rotate(0deg) scale(1)';
        });
    </script>
</body>

</html>
