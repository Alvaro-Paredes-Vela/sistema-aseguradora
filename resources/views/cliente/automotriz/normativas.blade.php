<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normativas y Leyes - Seguro Automotriz | Aseguradora Pankej</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Poppins + Orbitron -->
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.7;
        }

        /* === HEADER === */
        .header {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(12px);
            padding: 1.2rem 0;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.12);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-left: 1.5rem;
        }

        .logo {
            width: 68px;
            height: 68px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 2.4rem;
            font-weight: 900;
            color: white;
            box-shadow: 0 8px 28px rgba(30, 58, 138, 0.35);
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .logo::before {
            content: 'P';
            z-index: 1;
        }

        .logo::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .logo:hover::after {
            left: 100%;
        }

        .logo:hover {
            transform: scale(1.08) rotate(5deg);
            box-shadow: 0 12px 35px rgba(30, 58, 138, 0.45);
        }

        .company-name {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 1.6rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .company-subtitle {
            font-size: 0.78rem;
            color: #6b7280;
            font-weight: 500;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .btn-soat {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 0.7rem 1.8rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
        }

        .btn-soat:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(30, 58, 138, 0.4);
        }

        /* === SECCIÓN PRINCIPAL === */
        .normativas-section {
            flex: 1;
            padding: 5rem 0;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
        }

        .normativas-title {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .normativas-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.8rem;
            margin-bottom: 1rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        .normativas-title p {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 750px;
            margin: 0 auto;
            font-weight: 300;
        }

        .normativas-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .normativa-card {
            background: white;
            border-radius: 18px;
            margin-bottom: 1.5rem;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            transition: all 0.35s ease;
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .normativa-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
            border-color: var(--secondary-color);
        }

        .normativa-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .normativa-icon {
            width: 50px;
            height: 50px;
            background: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .normativa-title {
            font-weight: 700;
            font-size: 1.35rem;
            color: var(--dark-color);
            margin: 0;
        }

        .normativa-subtitle {
            font-size: 0.95rem;
            color: #6b7280;
            font-style: italic;
            margin-top: 0.3rem;
        }

        .normativa-content {
            margin-top: 1.2rem;
            color: #444;
            font-size: 0.98rem;
            line-height: 1.75;
        }

        .normativa-content ul {
            padding-left: 1.3rem;
            margin: 0.8rem 0;
        }

        .normativa-content li {
            margin-bottom: 0.5rem;
        }

        .normativa-link {
            display: inline-block;
            margin-top: 1rem;
            color: var(--secondary-color);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .normativa-link:hover {
            text-decoration: underline;
        }

        /* === FOOTER === */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: auto;
            font-size: 0.9rem;
        }

        footer a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .logo {
                width: 55px;
                height: 55px;
                font-size: 2rem;
            }

            .company-name {
                font-size: 1.3rem;
            }

            .normativas-title h1 {
                font-size: 2.2rem;
            }

            .normativa-header {
                flex-direction: column;
                text-align: center;
                gap: 0.8rem;
            }

            .normativa-icon {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }

            .normativa-title {
                font-size: 1.2rem;
            }

            .btn-soat {
                padding: 0.6rem 1.4rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo-container">
                <div class="logo"></div>
                <div>
                    <div class="company-name">Aseguradora Pankej</div>
                    <small class="company-subtitle">Seguro Automotriz</small>
                </div>
            </div>
            <div class="back-button">
                <a href="{{ route('automotriz') }}" class="btn btn-soat">Volver a Automotriz</a>
                <a href="tel:800109999" class="btn btn-soat">800-10-9999</a>
            </div>
        </div>
    </header>

    <!-- SECCIÓN NORMATIVAS -->
    <section class="normativas-section">
        <div class="container">
            <div class="normativas-title">
                <h1>Normativas y Leyes</h1>
                <p>Conoce las leyes y regulaciones que rigen el Seguro Automotriz Obligatorio en Bolivia. Cumplimiento
                    garantizado.</p>
            </div>

            <div class="normativas-container">

                <!-- Norma 1 -->
                <div class="normativa-card">
                    <div class="normativa-header">
                        <div class="normativa-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div>
                            <h3 class="normativa-title">Ley N° 1883 - Ley del Seguro Social Obligatorio</h3>
                            <p class="normativa-subtitle">Ley de 25 de junio de 1998</p>
                        </div>
                    </div>
                    <div class="normativa-content">
                        <p>Establece la obligatoriedad del seguro contra accidentes de tránsito para todo vehículo
                            motorizado que circule en territorio nacional.</p>
                        <ul>
                            <li>Todo propietario debe contratar SOAT antes de circular.</li>
                            <li>Cobertura mínima: Bs. 24.000 por muerte, Bs. 12.000 por incapacidad.</li>
                            <li>Vigencia: 1 año desde la fecha de emisión.</li>
                        </ul>
                        <a href="https://www.lexivox.org/norms/BO-L-1883.html" target="_blank" class="normativa-link">
                            Ver Ley Completa <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>

                <!-- Norma 2 -->
                <div class="normativa-card">
                    <div class="normativa-header">
                        <div class="normativa-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <div>
                            <h3 class="normativa-title">Decreto Supremo N° 27295</h3>
                            <p class="normativa-subtitle">Reglamentación del SOAT - 20 de diciembre de 2003</p>
                        </div>
                    </div>
                    <div class="normativa-content">
                        <p>Reglamenta la aplicación, cobertura, procedimiento de siniestros y sanciones del SOAT.</p>
                        <ul>
                            <li>Plazo para notificar siniestro: 15 días hábiles.</li>
                            <li>Indemnización máxima: Bs. 80.000 por evento.</li>
                            <li>Exclusiones: conducción bajo efectos del alcohol, uso no autorizado.</li>
                        </ul>
                        <a href="https://www.aps.gob.bo/files/webdocs/DJ/normativa/seguros/Decreto_Supremo_27295.pdf"
                            target="_blank" class="normativa-link">
                            Ver Decreto Completo <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>

                <!-- Norma 3 -->
                <div class="normativa-card">
                    <div class="normativa-header">
                        <div class="normativa-icon">
                            <i class="fas fa-car-crash"></i>
                        </div>
                        <div>
                            <h3 class="normativa-title">Código de Tránsito - Ley N° 112</h3>
                            <p class="normativa-subtitle">Ley General de Tránsito y Transporte Terrestre - 23 de
                                diciembre de 2009</p>
                        </div>
                    </div>
                    <div class="normativa-content">
                        <p>Regula la circulación vehicular, infracciones, sanciones y prohíbe expresamente circular sin
                            SOAT vigente.</p>
                        <ul>
                            <li>Multa por circular sin SOAT: 300 UFV (aprox. Bs. 780 en 2025)</li>
                            <li>Retención preventiva del vehículo</li>
                            <li>Obligación de portar y exhibir el SOAT físico o digital</li>
                        </ul>
                        <a href="https://www.lexivox.org/norms/BO-L-N112.html" target="_blank" class="normativa-link">
                            Consulta Tránsito <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>

                <!-- Norma 4 -->
                <div class="normativa-card">
                    <div class="normativa-header">
                        <div class="normativa-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h3 class="normativa-title">Resolución Administrativa APS N° 045/2024</h3>
                            <p class="normativa-subtitle">Actualización de tarifas SOAT 2025</p>
                        </div>
                    </div>
                    <div class="normativa-content">
                        <p>Autoridad de Supervisión del Sistema Financiero (ASFI) fija tarifas anuales según categoría
                            del vehículo.</p>
                        <ul>
                            <li>Automóvil particular: Bs. 120</li>
                            <li>Motocicleta: Bs. 60</li>
                            <li>Camión liviano: Bs. 200</li>
                        </ul>
                        <a href="https://www.asfi.gob.bo" target="_blank" class="normativa-link">
                            Ver Tarifario Oficial <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Aseguradora Pankej. Todos los derechos reservados. |
                <a href="#">Términos y Condiciones</a> |
                <a href="#">Política de Privacidad</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Efecto hover logo
        const logo = document.querySelector('.logo');
        logo.addEventListener('mouseenter', () => logo.style.transform = 'scale(1.08) rotate(5deg)');
        logo.addEventListener('mouseleave', () => logo.style.transform = 'scale(1) rotate(0deg)');
    </script>
</body>

</html>
