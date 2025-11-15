<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Atención de Siniestro - Aseguradora Pankej</title>

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

        .btn-back,
        .btn-report {
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

        .btn-back:hover,
        .btn-report:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
        }

        /* Sección principal */
        .guide-section {
            flex: 1;
            padding: 4rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .guide-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .guide-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .guide-title p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 700px;
            margin: 0 auto;
        }

        .steps-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .step {
            background: white;
            border-radius: 15px;
            margin-bottom: 1rem;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .step:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .step-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            margin-right: 1rem;
        }

        /* Colores por paso */
        .step-1 .step-number {
            background: #f59e0b;
        }

        .step-2 .step-number {
            background: #10b981;
        }

        .step-3 .step-number {
            background: #10b981;
        }

        .step-4 .step-number {
            background: #ef4444;
        }

        .step-5 .step-number {
            background: #ef4444;
        }

        .step-6 .step-number {
            background: #3b82f6;
        }

        .step-7 .step-number {
            background: #8b5cf6;
        }

        .step-title {
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--dark-color);
        }

        .step-description {
            color: #555;
            line-height: 1.6;
            font-size: 0.95rem;
            display: none;
            /* Oculto por defecto */
            margin-top: 1rem;
        }

        .step.active .step-description {
            display: block;
            /* Mostrado cuando el paso está activo */
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

        /* Responsive */
        @media (max-width: 768px) {
            .logo {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            .company-name {
                font-size: 1.2rem;
            }

            .guide-title h1 {
                font-size: 2rem;
            }

            .step-header {
                flex-direction: column;
                text-align: center;
            }

            .step-number {
                margin: 0 0 0.5rem 0;
            }

            .step {
                padding: 1.5rem;
            }

            .btn-back,
            .btn-report {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Header con logo y botón -->
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
                <a href="{{ route('contactar') }}" class="btn btn-report">Contactar</a>
            </div>
        </div>
    </header>

    <!-- Sección de guía -->
    <section class="guide-section">
        <div class="container">
            <div class="guide-title">
                <h1>Guía de Atención de Siniestro</h1>
                <p>Sigue estos pasos para reportar y gestionar un siniestro con Aseguradora Pankej. Estamos contigo
                    24/7.</p>
            </div>

            <div class="steps-container">
                <!-- Paso 1 -->
                <div class="step step-1" onclick="toggleStep(this)">
                    <div class="step-header">
                        <div class="step-number">1</div>
                        <h4 class="step-title">Suceso del accidente de tránsito</h4>
                    </div>
                    <div class="step-description">
                        <p>Las víctimas son auxiliadas al centro médico más cercano. Aviso del siniestro al organismo
                            operativo de tránsito.</p>
                    </div>
                </div>

                <!-- Paso 2 -->
                <div class="step step-2" onclick="toggleStep(this)">
                    <div class="step-header">
                        <div class="step-number">2</div>
                        <h4 class="step-title">Aviso del siniestro a Aseguradora Pankej</h4>
                    </div>
                    <div class="step-description">
                        <p>En el plazo de 15 días y puede ser realizado por: Centro médico, organismo operativo de
                            tránsito, víctimas, conductor o propietario del vehículo, o cualquier persona que acredite
                            interés legal.</p>
                    </div>
                </div>

                <!-- Paso 3 -->
                <div class="step step-3" onclick="toggleStep(this)">
                    <div class="step-header">
                        <div class="step-number">3</div>
                        <h4 class="step-title">Apertura del reclamo y verificación de causales de exclusión de cobertura
                        </h4>
                    </div>
                    <div class="step-description">
                        <p>Con el aviso del siniestro, se procede a la asignación del código correspondiente al reclamo
                            y a la apertura física del file con la documentación presentada. A su vez, se evalúa las
                            circunstancias en las que ocurrió el siniestro para su cobertura, verificándose si éstas se
                            enmarcan en alguna de las causales de exclusión de cobertura señaladas en el artículo 32 del
                            Decreto Supremo 27295 de 20 de diciembre de 2003.</p>
                    </div>
                </div>

                <!-- Paso 4 -->
                <div class="step step-4" onclick="toggleStep(this)">
                    <div class="step-header">
                        <div class="step-number">4</div>
                        <h4 class="step-title">Entrega de formulario de requisitos para la cobertura</h4>
                    </div>
                    <div class="step-description">
                        <p>De acuerdo a la evaluación del siniestro y las coberturas requeridas, se entrega al cliente
                            el formulario con la documentación necesaria para otorgar la cobertura correspondiente, de
                            conformidad al artículo 29 del Decreto Supremo 27295 de 20 de diciembre de 2003.</p>
                    </div>
                </div>

                <!-- Paso 5 -->
                <div class="step step-5" onclick="toggleStep(this)">
                    <div class="step-header">
                        <div class="step-number">5</div>
                        <h4 class="step-title">Entrega de la documentación</h4>
                    </div>
                    <div class="step-description">
                        <p><strong>Heridos:</strong> Documento que identifique al herido, certificado emitido por el
                            organismo operativo de tránsito, certificado médico. En caso de víctimas que hayan cancelado
                            al centro médico, se solicitarán recibos y/o facturas.<br><strong>Fallecidos:</strong>
                            Documento que identifique al fallecido, certificado emitido por el organismo operativo de
                            tránsito, certificado médico forense o certificado médico (si
                            corresponde).<br><strong>Incapacidad total y permanente:</strong> Documento que identifique
                            al herido, certificado emitido por el organismo operativo de tránsito, dictamen de
                            calificación de incapacidad emitido por la EEC. Aseguradora Pankej, a requerimiento de la
                            víctima, solicitará la calificación de incapacidad de conformidad al artículo 26 del Decreto
                            Supremo 27295.</p>
                    </div>
                </div>

                <!-- Paso 6 -->
                <div class="step step-6" onclick="toggleStep(this)">
                    <div class="step-header">
                        <div class="step-number">6</div>
                        <h4 class="step-title">Pago de la indemnización</h4>
                    </div>
                    <div class="step-description">
                        <p>Plazo de pago: 15 días hábiles a partir de la recepción de los documentos necesarios.
                            <strong>Indemnización por gastos médicos:</strong> Pago de las proformas al centro médico.
                            En caso de recibos y/o facturas de las víctimas, se procede a su reembolso.
                            <strong>Indemnización por fallecimiento:</strong> Pago a los derechohabientes del fallecido.
                            En caso de conflicto de intereses entre los derechohabientes, se realiza un depósito
                            judicial. <strong>Indemnización por incapacidad permanente:</strong> Pago de la
                            indemnización a la víctima.
                        </p>
                    </div>
                </div>

                <!-- Paso 7 -->
                <div class="step step-7" onclick="toggleStep(this)">
                    <div class="step-header">
                        <div class="step-number">7</div>
                        <h4 class="step-title">Ejercicio del Derecho de repetición</h4>
                    </div>
                    <div class="step-description">
                        <p>Se verifica la conclusión del reclamo con el pago de todas las indemnizaciones del siniestro.
                            Inicio del proceso de repetición ante la autoridad competente en caso de existir causales de
                            repetición.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Aseguradora Pankej. Todos los derechos reservados. |
                <a href="#">Términos y Condiciones</a> |
                <a href="#">Política de Privacidad</a>
            </p>
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

        // Función para alternar la expansión de los pasos
        function toggleStep(step) {
            const description = step.querySelector('.step-description');
            const allSteps = document.querySelectorAll('.step');

            allSteps.forEach(s => s.classList.remove('active')); // Cierra todos los pasos
            step.classList.toggle('active'); // Expande o colapsa el paso seleccionado
        }
    </script>
</body>

</html>
