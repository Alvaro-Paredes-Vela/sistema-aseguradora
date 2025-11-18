<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Siniestro Automotriz - Aseguradora Pankej</title>

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
        .guide-section {
            flex: 1;
            padding: 5rem 0;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
        }

        .guide-title {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .guide-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.8rem;
            margin-bottom: 1rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        .guide-title p {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 750px;
            margin: 0 auto;
            font-weight: 300;
        }

        .steps-container {
            max-width: 780px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .step {
            background: white;
            border-radius: 18px;
            margin-bottom: 1.3rem;
            padding: 1.8rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .step:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
            border-color: var(--secondary-color);
        }

        .step-header {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .step-number {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .step-title {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--dark-color);
            flex: 1;
        }

        .step-icon {
            font-size: 1.4rem;
            color: #94a3b8;
            transition: transform 0.3s ease;
        }

        .step.active .step-icon {
            transform: rotate(180deg);
            color: var(--secondary-color);
        }

        .step-description {
            margin-top: 1.2rem;
            color: #555;
            font-size: 0.98rem;
            line-height: 1.75;
            display: none;
        }

        .step.active .step-description {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        /* === COLORES POR PASO === */
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

        /* === ANIMATIONS === */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

            .guide-title h1 {
                font-size: 2.2rem;
            }

            .step-header {
                flex-direction: column;
                text-align: center;
                gap: 0.8rem;
            }

            .step-number {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }

            .step-title {
                font-size: 1.15rem;
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
                <a href="tel:69334868" class="btn btn-soat">693-34-868</a>
            </div>
        </div>
    </header>

    <!-- SECCIÓN GUÍA -->
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
                        <h4 class="step-title">Suceso del Accidente</h4>
                        <i class="fas fa-chevron-down step-icon"></i>
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
                        <h4 class="step-title">Aviso del Siniestro a Aseguradora Pankej</h4>
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
                        <h4 class="step-title">Apertura del Reclamo y Verificación de Causales de Exclusión de Cobertura
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
                        <h4 class="step-title">Entrega de Formulario de Requisitos para la Cobertura</h4>
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
                        <h4 class="step-title">Entrega de la Documentación</h4>
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
                        <h4 class="step-title">Pago de la Indemnización</h4>
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
                        <h4 class="step-title">Ejercicio del Derecho de Repetición</h4>
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
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Función para alternar la expansión de los pasos
        function toggleStep(step) {
            const description = step.querySelector('.step-description');
            const allSteps = document.querySelectorAll('.step');

            allSteps.forEach(s => s.classList.remove('active')); // Cierra todos los pasos
            step.classList.toggle('active'); // Expande o colapsa el paso seleccionado
        }

        // Auto-abrir primer paso
        document.querySelector('.step').classList.add('active');
    </script>
</body>

</html>
