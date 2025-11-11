{{-- resources/views/cliente/Comprar-Soat/comprobar-soat.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante Digital - Aseguradora Pankej</title>

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
            justify-content: center;
            align-items: center;
        }

        .login-container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .login-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .login-title p {
            color: #666;
        }

        .login-form .form-group {
            margin-bottom: 1.5rem;
        }

        .login-form label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
        }

        .login-form input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.95rem;
            text-transform: uppercase;
        }

        .btn-login {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 1rem;
        }

        .success-message {
            color: #10b981;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 1.5rem;
            }

            .login-title h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-title">
            <h1>Comprobante SOAT</h1>
            <p>Ingresa tu RUAT y placa para descargar tu póliza digital.</p>
        </div>

        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('soat.comprobar') }}" method="POST" class="login-form">
            @csrf
            <div class="form-group">
                <label for="ruat">RUAT</label>
                <input type="text" id="ruat" name="ruat" required placeholder="Ej. RUAT-ABC-123456"
                    value="{{ old('ruat') }}">
            </div>
            <div class="form-group">
                <label for="placa">Número de Placa</label>
                <input type="text" id="placa" name="placa" required placeholder="Ej. 5842BNY"
                    value="{{ old('placa') }}">
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-search"></i> Buscar SOAT
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
