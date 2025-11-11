{{-- resources/views/cliente/verificar-vigencia.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Vigencia - Aseguradora Pankej</title>

    <!-- Bootstrap 5 CSS -->
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
            display: flex;
            flex-direction: column;
        }

        /* Header con logo y botón */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-left: 1rem;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            font-weight: 900;
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
            position: relative;
            overflow: hidden;
        }

        .logo::before {
            content: 'P';
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
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
            font-size: 1.5rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .back-button {
            padding-right: 1rem;
        }

        .btn-back {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-left: 1rem;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
        }

        /* Sección principal */
        .verify-section {
            flex: 1;
            padding: 4rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .verify-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .verify-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .verify-title p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 700px;
            margin: 0 auto;
        }

        .verify-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 1rem;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .verify-form .form-group {
            margin-bottom: 1.5rem;
        }

        .verify-form label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
        }

        .verify-form input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.95rem;
            text-transform: uppercase;
        }

        .btn-verify {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
        }

        .result {
            margin-top: 1.5rem;
            padding: 1rem;
            border-radius: 8px;
        }

        .result.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .result.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .download-btn {
            display: block;
            width: 100%;
            margin-top: 1rem;
            padding: 10px;
            background: #10b981;
            color: white;
            text-align: center;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
        }

        .download-btn:hover {
            background: #059669;
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            margin-top: auto;
        }

        footer a {
            color: var(--secondary-color);
            text-decoration: none;
            margin: 0 0.5rem;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .logo {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            .company-name {
                font-size: 1.2rem;
            }

            .verify-title h1 {
                font-size: 2rem;
            }

            .verify-container {
                padding: 1.5rem;
            }

            .btn-back {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Header con logo y botón (ESTILO ORIGINAL INTACTO) -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo-container">
                <div class="logo"></div>
                <div>
                    <div class="company-name">Aseguradora Pankej</div>
                    <small class="text-muted">Seguros y Reaseguros Personales</small>
                </div>
            </div>
            <div class="back-button">
                <a href="{{ route('home') }}" class="btn btn-back">Volver a Inicio</a>
            </div>
        </div>
    </header>

    <!-- Sección de verificación -->
    <section class="verify-section">
        <div class="container">
            <div class="verify-title">
                <h1>Verificar Vigencia</h1>
                <p>Ingresa <strong>tu placa</strong> o <strong>RUAT</strong> (solo uno es necesario)</p>
            </div>

            <div class="verify-container">
                <!-- MENSAJES -->
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('poliza'))
                    <div class="result success">
                        <strong>SOAT VIGENTE</strong><br>
                        Válido hasta: <strong>{{ session('poliza.fecha_vencimiento') }}</strong><br>
                        Vehículo: <strong>{{ session('poliza.vehiculo') }}</strong>
                        <a href="{{ route('soat.comprobante', session('poliza.id_venta')) }}" class="download-btn">
                            Descargar Póliza PDF
                        </a>
                    </div>
                @endif

                <!-- FORMULARIO -->
                <form action="{{ route('soat.verificar') }}" method="POST" class="verify-form">
                    @csrf
                    <div class="form-group">
                        <label for="busqueda">Placa o RUAT</label>
                        <input type="text" id="busqueda" name="busqueda" required
                            placeholder="Ej. 5842BNY o RUAT-ABC-123456" value="{{ old('busqueda') }}">
                        <small class="text-muted">Puedes usar cualquiera de los dos</small>
                    </div>
                    <button type="submit" class="btn-verify">
                        Verificar Vigencia
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Aseguradora Pankej. Todos los derechos reservados. |
                <a href="#">Términos</a> | <a href="#">Privacidad</a>
            </p>
        </div>
    </footer>
</body>

</html>
