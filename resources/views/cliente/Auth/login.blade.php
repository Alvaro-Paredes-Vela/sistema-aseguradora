<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cliente SOAT Pankej</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a2a6c;
            --secondary-color: #2e5bff;
            --accent-color: #f4a261;
            --dark-color: #0f172a;
            --light-color: #f1f5f9;
        }

        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            background: url('https://img.freepik.com/fotos-premium/noche-lluviosa-ciudad-conduccion-automoviles-calles-humedas-reflexiones-gotas-lluvia-iluminan-escena-urbana_875722-62655.jpg?semt=ais_hybrid&w=740&q=80') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 1.8rem;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            text-align: center;
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(46, 91, 255, 0.1) 0%, transparent 70%);
            animation: glowPulse 6s infinite;
            z-index: -1;
        }

        @keyframes glowPulse {
            0% {
                transform: scale(0.8);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.2);
                opacity: 0;
            }

            100% {
                transform: scale(0.8);
                opacity: 0.6;
            }
        }

        .logo {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 2.5rem;
            font-weight: 900;
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.4);
            position: relative;
            animation: float 3s ease-in-out infinite;
        }

        .logo::before {
            content: 'P';
            font-family: 'Orbitron', sans-serif;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .login-card h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: var(--secondary-color);
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            font-size: 2.2rem;
        }

        .login-card h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
            transition: width 0.4s ease;
        }

        .login-card h1:hover::after {
            width: 80px;
        }

        .form-label {
            font-weight: 600;
            color: var(--light-color);
            text-align: left;
            margin-bottom: 0.4rem;
            font-size: 1.1rem;
        }

        .form-control {
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.6rem;
            height: 55px;
            font-size: 1rem;
            padding: 0.8rem 1.2rem;
            background: rgba(255, 255, 255, 0.15);
            color: var(--light-color);
            transition: all 0.4s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 15px rgba(46, 91, 255, 0.4);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(241, 245, 249, 0.7);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 0.8rem;
            padding: 14px;
            font-weight: 700;
            color: white;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-login:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-login:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(30, 58, 138, 0.5);
        }

        .register-link {
            margin-top: 2rem;
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            display: inline-block;
        }

        .register-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 0;
            background: var(--secondary-color);
            transition: width 0.4s ease;
        }

        .register-link:hover::after {
            width: 100%;
        }

        .register-link:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 2rem;
                max-width: 90%;
            }

            .logo {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .login-card h1 {
                font-size: 1.8rem;
            }

            .form-control {
                height: 50px;
            }
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            text-align: left;
            margin-top: 0.25rem;
        }

        .welcome-message {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: var(--secondary-color);
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.8rem;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo"></div>
        @if (Session::has('cliente_id'))
            <?php $nombreCompleto = Session::get('cliente_nombre', 'Cliente'); ?>
            <h1 class="welcome-message">Bienvenido, {{ $nombreCompleto }}</h1>
            <form method="POST" action="{{ route('clientes.logout') }}">
                @csrf
                <button type="submit" class="btn btn-login w-100">Cerrar Sesión</button>
            </form>
        @else
            <h1>INICIO DE SESIÓN</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('cliente.authenticate') }}">
                @csrf
                <div class="mb-4 text-start">
                    <label for="login" class="form-label">Usuario (Login)</label>
                    <input type="text" name="login" id="login"
                        class="form-control @error('login') is-invalid @enderror" placeholder="Ingresa tu usuario"
                        value="{{ old('login') }}" required autofocus>
                    @error('login')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 text-start">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Ingresa tu contraseña"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login w-100">Iniciar Sesión</button>
            </form>
            <p class="mt-3">¿No tienes cuenta? <a href="{{ route('cliente.register') }}"
                    class="register-link">Regístrate
                    ahora</a></p>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
