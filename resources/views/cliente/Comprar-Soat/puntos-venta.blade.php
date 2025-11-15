<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntos de Venta SOAT - Aseguradora Pankej</title>

    <!-- Bootstrap 5 CSS -->
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
            transition: transform 0.4s ease;
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
            font-size: 0.9rem;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
        }

        .map-section {
            flex: 1;
            padding: 4rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .map-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .map-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .map-title p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 700px;
            margin: 0 auto;
        }

        .map-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 1rem;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            height: 600px;
        }

        .map-iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .info-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin: 1rem 1rem 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .info-card h5 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.8rem;
        }

        .info-card p {
            margin: 0.5rem 0;
            font-size: 0.95rem;
            color: #555;
        }

        .info-card a {
            display: inline-block;
            margin-top: 1rem;
            padding: 8px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .info-card a:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

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
            .map-title h1 {
                font-size: 2rem;
            }

            .map-container {
                height: 450px;
                margin: 0 0.5rem;
                border-radius: 16px;
            }

            .info-card {
                margin: 1rem 0.5rem;
                padding: 1.2rem;
            }

            .logo {
                width: 50px;
                height: 50px;
            }

            .company-name {
                font-size: 1.2rem;
            }

            .btn-back {
                padding: 8px 18px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo-container">
                <div class="logo"></div>
                <div>
                    <div class="company-name">Aseguradora Pankej</div>
                    <small class="text-muted">SOAT - Puntos de Venta</small>
                </div>
            </div>
            <div class="back-button">
                <a href="{{ route('home') }}" class="btn btn-back">Volver a Inicio</a>
            </div>
        </div>
        |
    </header>

    <!-- Sección del Mapa -->
    <section class="map-section">
        <div class="container">
            <div class="map-title">
                <h1>Puntos de Venta SOAT</h1>
                <p>Vista Satelital</p>
            </div>

            <!-- MAPA SATELITAL CON PIN ROJO -->
            <div class="map-container">
                <iframe class="map-iframe"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d954.999!2d-63.2684287!3d-17.3385489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93ee3e96d3f22e9f%3A0x9e0c80e8a775fd3!2sFacultad+Integral+del+Norte+FINOR+UAGRM!5e1!3m2!1ses!2sbo!4v1712345678901"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>

            <!-- INFO DE FINOR -->
            <div class="info-card">
                <h5>Facultad Integral del Norte (FINOR) - UAGRM</h5>
                <p><i class="fas fa-map-marker-alt text-danger"></i> <strong>MP6J+HJP</strong> - Av. Circunvalación
                    Noroeste, Urkupiña</p>
                <p><i class="fas fa-university text-primary"></i> Montero, Santa Cruz, Bolivia</p>
                <p><i class="fas fa-phone text-success"></i> +591 6 933 4868</p>
                <p><i class="fas fa-clock text-primary"></i> Lun-Vie: 8:00 - 18:00 | Sáb: 8:00 - 12:00</p>
                <a href="https://www.google.com/maps/dir//MP6J%2BHJP+Facultad+Integral+del+Norte+FINOR+UAGRM,+Urkupi%C3%B1a,+Av.+Circunvalacion+Noroeste,+Montero/@-17.3385948,-63.2701683,18z/data=!4m16!1m7!3m6!1s0x93ee3e96d3f22e9f:0x9e0c80e8a775fd3!2sFacultad+Integral+del+Norte+FINOR+UAGRM!8m2!3d-17.3385489!4d-63.2684287!16s%2Fg%2F1thvj0d8!4m7!1m0!1m5!1m1!1s0x93ee3e96d3f22e9f:0x9e0c80e8a775fd3!2m2!1d-63.2684287!2d-17.3385489?authuser=0&entry=ttu&g_ep=EgoyMDI1MTExMC4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank">
                    Cómo llegar
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© 2025 Aseguradora Pankej. Todos los derechos reservados. |
                <a href="">Términos</a> | <a href="">Privacidad</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
