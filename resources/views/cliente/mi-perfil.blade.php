<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Aseguradora Pankej</title>

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

        .profile-section {
            padding: 4rem 0;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit liquidated;
            border-radius: 50%;
            border: 3px solid var(--primary-color);
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.3);
            transition: transform 0.3s ease;
            margin: 0 auto 1.5rem;
            display: block;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .profile-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            color: var(--dark-color);
            font-weight: 500;
        }

        .form-control {
            background: #f8fafc;
            border: 1px solid var(--primary-color);
            border-radius: 10px;
            color: var(--dark-color);
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 10px rgba(30, 58, 138, 0.3);
            background: #f8fafc;
        }

        .alert-success {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid var(--primary-color);
            color: var(--dark-color);
            border-radius: 10px;
        }

        .alert-danger {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #dc3545;
            color: var(--dark-color);
            border-radius: 10px;
        }

        .btn-primary-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
            color: white;
        }

        .btn-danger-custom {
            background: linear-gradient(45deg, #dc3545, #a71d2a);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
        }

        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.3);
            color: white;
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
        }

        footer p {
            margin: 0;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .profile-title {
                font-size: 2rem;
            }

            .profile-img {
                width: 120px;
                height: 120px;
            }

            .logo {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .company-name {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 576px) {
            .profile-img {
                width: 100px;
                height: 100px;
            }
        }

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

        .profile-card {
            animation: fadeInUp 0.6s ease forwards;
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
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ route('contactar') }}#contacto">Contáctanos</a>
                            </li>
                            @if (Session::has('cliente_id'))
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('clientes.edit', Session::get('cliente_id')) }}">
                                        <i class="fas fa-user me-1"></i>Perfil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom btn-sm ms-2" href="{{ route('clientes.logout') }}">
                                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom btn-sm ms-2" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom btn-sm ms-2"
                                        href="{{ route('register.cliente') }}">
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

    <!-- Profile Section -->
    <section class="profile-section">
        <div class="container">
            <h2 class="profile-title">Mi Perfil</h2>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="profile-card">
                        <div class="text-center mb-4">
                            @if ($cliente->foto)
                                <img src="{{ asset('storage/' . $cliente->foto . '?t=' . time()) }}"
                                    alt="Foto de perfil" class="profile-img">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Foto de perfil" class="profile-img">
                            @endif
                        </div>
                        <!-- Formulario de Actualización -->
                        <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto de Perfil</label>
                                <input type="file" class="form-control" id="foto" name="foto"
                                    accept="image/*">
                                @error('foto')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="{{ old('nombre', $cliente->nombre) }}">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="paterno" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="paterno" name="paterno"
                                        value="{{ old('paterno', $cliente->paterno) }}">
                                    @error('paterno')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="materno" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="materno" name="materno"
                                        value="{{ old('materno', $cliente->materno) }}">
                                    @error('materno')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="correo" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo"
                                        value="{{ old('correo', $cliente->correo) }}">
                                    @error('correo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        value="{{ old('telefono', $cliente->telefono) }}">
                                    @error('telefono')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        value="{{ old('direccion', $cliente->direccion) }}">
                                    @error('direccion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4 d-flex gap-5 justify-content-center">
                                <button type="submit" class="btn btn-primary-custom">Actualizar Perfil</button>
                            </div>
                        </form>
                        <!-- Formulario de Eliminación -->
                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST"
                            class="mt-3 d-flex justify-content-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-custom"
                                onclick="return confirm('¿Estás seguro de eliminar tu cuenta? Esta acción no se puede deshacer.');">
                                Eliminar Cuenta
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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
