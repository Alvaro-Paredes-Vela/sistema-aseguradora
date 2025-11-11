<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Cliente SOAT Pankej</title>
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
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            background: url('https://img.freepik.com/fotos-premium/noche-lluviosa-ciudad-conduccion-automoviles-calles-humedas-reflexiones-gotas-lluvia-iluminan-escena-urbana_875722-62655.jpg?semt=ais_hybrid&w=740&q=80') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
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

        .register-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 1.5rem;
            padding: 1.5rem;
            width: 100%;
            max-width: 700px;
            /* Ajustado para dos columnas */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .register-card:hover {
            transform: translateY(-5px);
        }

        .register-card::before {
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
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
            font-weight: 900;
            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
            position: relative;
            animation: float 3s ease-in-out infinite;
        }

        .logo::before {
            content: 'P';
            font-family: 'Orbitron', sans-serif;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .register-card h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            font-size: 1.8rem;
        }

        .register-card h1::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 2px;
            transition: width 0.4s ease;
        }

        .register-card h1:hover::after {
            width: 60px;
        }

        .form-label {
            font-weight: 600;
            color: var(--light-color);
            text-align: left;
            margin-bottom: 0.3rem;
            font-size: 1rem;
        }

        .form-control {
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            height: 45px;
            font-size: 0.95rem;
            padding: 0.6rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            color: var(--light-color);
            transition: all 0.4s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 10px rgba(46, 91, 255, 0.3);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(241, 245, 249, 0.7);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 0.7rem;
            padding: 10px;
            font-weight: 700;
            color: white;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .btn-register::before {
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

        .btn-register:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-register:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.4);
        }

        .login-link {
            margin-top: 1.5rem;
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            position: relative;
            display: inline-block;
        }

        .login-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background: var(--secondary-color);
            transition: width 0.4s ease;
        }

        .login-link:hover::after {
            width: 100%;
        }

        .login-link:hover {
            color: var(--secondary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-card {
                max-width: 85%;
                padding: 1rem;
            }

            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .logo {
                width: 60px;
                height: 60px;
                font-size: 1.8rem;
            }

            .register-card h1 {
                font-size: 1.6rem;
            }

            .form-control {
                height: 40px;
            }
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            text-align: left;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="register-card">
        <div class="logo"></div>
        <h1>REGISTRATE Y COMIENZA HOY!</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('cliente.register') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="login" class="form-label">Usuario (Login)</label>
                    <input type="text" name="login" id="login"
                        class="form-control @error('login') is-invalid @enderror" placeholder="Ingresa tu usuario"
                        value="{{ old('login') }}" required>
                    @error('login')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Ingresa tu contraseña"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo"
                        class="form-control @error('correo') is-invalid @enderror" placeholder="Ingresa tu correo"
                        value="{{ old('correo') }}">
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="form-control @error('nombres') is-invalid @enderror" placeholder="Ingresa tu nombre"
                        value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="paterno" class="form-label">Apellido Paterno</label>
                    <input type="text" name="paterno" id="paterno"
                        class="form-control @error('paterno') is-invalid @enderror"
                        placeholder="Ingresa tu apellido paterno" value="{{ old('paterno') }}">
                    @error('paterno')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="materno" class="form-label">Apellido Materno</label>
                    <input type="text" name="materno" id="materno"
                        class="form-control @error('materno') is-invalid @enderror"
                        placeholder="Ingresa tu apellido materno" value="{{ old('materno') }}">
                    @error('materno')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" id="direccion"
                        class="form-control @error('direccion') is-invalid @enderror" placeholder="Ingresa tu dirección"
                        value="{{ old('direccion') }}">
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" id="telefono"
                        class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingresa tu teléfono"
                        value="{{ old('telefono') }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3 offset-md-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-register w-100">Registrarse</button>
        </form>
        <p class="mt-3">¿Ya tienes cuenta? <a href="{{ route('cliente.login') }}" class="login-link">Inicia
                sesión
                ahora</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
