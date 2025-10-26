<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Comprobante Digital - Aseguradora Pankej</title>

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
            display: none;
        }

        /* Responsive */
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
            <h1>Iniciar Sesión</h1>
            <p>Ingresa tus datos para acceder a tu comprobante digital.</p>
        </div>

        <form id="loginForm" class="login-form">
            <div class="form-group">
                <label for="plateNumber">Número de Placa</label>
                <input type="text" id="plateNumber" name="plateNumber" required placeholder="Ej. ABC123">
            </div>
            <div class="form-group">
                <label for="gestor">Gestor</label>
                <input type="text" id="gestor" name="gestor" required placeholder="Ej. 12345">
            </div>
            <div class="form-group">
                <label for="securityCode">Código de Seguridad</label>
                <input type="text" id="securityCode" name="securityCode" required placeholder="Ej. X7K9P2">
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
            <div id="errorMessage" class="error-message"></div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const plateNumber = document.getElementById('plateNumber').value;
            const gestor = document.getElementById('gestor').value;
            const securityCode = document.getElementById('securityCode').value;
            const errorMessage = document.getElementById('errorMessage');

            // Simulación de validación (reemplazar con llamada a backend)
            if (plateNumber === 'ABC123' && gestor === '12345' && securityCode === 'X7K9P2') {
                // Redirigir a la vista del comprobante (ajustar ruta según backend)
                window.location.href = '{{ route('comprobante.digital') }}';
            } else {
                errorMessage.textContent = 'Datos incorrectos. Verifica tu placa, gestor o código de seguridad.';
                errorMessage.style.display = 'block';
            }
        });
    </script>
</body>

</html>
