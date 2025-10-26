<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Siniestro - Aseguradora Pankej</title>

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
            text-decoration: none;
        }

        .btn-back:hover {
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

        /* Formulario específico para reportar siniestro */
        .form-section {
            flex: 1;
            padding: 4rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .form-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 1rem;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-title h2 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-title p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 700px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid var(--primary-color);
            border-radius: 0.75rem;
            height: 45px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }

        .btn-submit {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
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

            .btn-back {
                margin-left: 0;
            }

            .form-container {
                padding: 1.5rem;
            }

            .form-title h2 {
                font-size: 2rem;
            }

            .btn-submit {
                padding: 10px 20px;
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
                <a href="{{ route('guia.siniestro') }}" class="btn btn-back">Volver a Guia</a>
            </div>
        </div>
    </header>

    <!-- Sección del formulario -->
    <section class="form-section">
        <div class="container">
            <div class="form-container">
                <div class="guide-title">
                    <h2>Registrar Denuncia de Siniestro</h2>
                    <p>Completa los datos para iniciar el proceso de reporte de siniestro.</p>
                </div>

                <form method="POST" action="{{ route('reportar.siniestro') }}">
                    @csrf

                    <!-- Datos del Asegurado -->
                    <h3 class="form-label mb-3" style="font-size: 1.5rem; color: var(--dark-color);">Datos del Asegurado
                    </h3>
                    <div class="form-group">
                        <label for="nombre_asegurado" class="form-label">Nombre completo del Asegurado</label>
                        <input type="text" class="form-control" id="nombre_asegurado" name="nombre_asegurado"
                            placeholder="Ej: Juan Pérez" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_celular" class="form-label">Número de Celular</label>
                        <input type="tel" class="form-control" id="numero_celular" name="numero_celular"
                            placeholder="Ej: 71234567" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico"
                            placeholder="Ej: juan@example.com" required>
                    </div>

                    <!-- Datos del Conductor -->
                    <h3 class="form-label mb-3" style="font-size: 1.5rem; color: var(--dark-color);">Datos del Conductor
                    </h3>
                    <div class="form-group">
                        <label for="nombre_conductor" class="form-label">Nombre(s) del Conductor</label>
                        <input type="text" class="form-control" id="nombre_conductor" name="nombre_conductor"
                            placeholder="Ej: Juan" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_conductor" class="form-label">Apellido(s) del Conductor</label>
                        <input type="text" class="form-control" id="apellido_conductor" name="apellido_conductor"
                            placeholder="Ej: Pérez" required>
                    </div>
                    <div class="form-group">
                        <label for="licencia_conducir" class="form-label">Número de Licencia de Conducir</label>
                        <input type="text" class="form-control" id="licencia_conducir" name="licencia_conducir"
                            placeholder="Ej: LIC123456" required>
                    </div>

                    <!-- Características del Vehículo -->
                    <h3 class="form-label mb-3" style="font-size: 1.5rem; color: var(--dark-color);">Características del
                        Vehículo</h3>
                    <div class="form-group">
                        <label for="numero_placa" class="form-label">Número de Placa</label>
                        <input type="text" class="form-control" id="numero_placa" name="numero_placa"
                            placeholder="Ej: ABC-123" required>
                    </div>

                    <!-- Ocurrencia del Siniestro -->
                    <h3 class="form-label mb-3" style="font-size: 1.5rem; color: var(--dark-color);">Ocurrencia del
                        Siniestro</h3>
                    <div class="form-group">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad"
                            placeholder="Ej: La Paz" required>
                    </div>
                    <div class="form-group">
                        <label for="oficina_regional" class="form-label">Seleccione Oficina Regional</label>
                        <select class="form-control" id="oficina_regional" name="oficina_regional" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="la_paz">La Paz</option>
                            <option value="cochabamba">Cochabamba</option>
                            <option value="santa_cruz">Santa Cruz</option>
                            <option value="oruro">Oruro</option>
                            <option value="potosi">Potosi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lugar_siniestro" class="form-label">Lugar del Siniestro</label>
                        <input type="text" class="form-control" id="lugar_siniestro" name="lugar_siniestro"
                            placeholder="Ej: Calle Principal" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion_hecho" class="form-label">Breve descripción del hecho</label>
                        <textarea class="form-control" id="descripcion_hecho" name="descripcion_hecho" rows="4"
                            placeholder="Ej: Colisión con otro vehículo a las 10:00 AM" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="danios_visibles" class="form-label">Daños Visibles del Vehículo asegurado</label>
                        <textarea class="form-control" id="danios_visibles" name="danios_visibles" rows="3"
                            placeholder="Ej: Daño en el parachoques delantero" required></textarea>
                    </div>

                    <!-- Archivos -->
                    <h3 class="form-label mb-3" style="font-size: 1.5rem; color: var(--dark-color);">Documentación
                    </h3>
                    <div class="form-group">
                        <label for="archivo_f" class="form-label">F</label>
                        <input type="file" class="form-control" id="archivo_f" name="archivo_f">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="archivo_dd" class="form-label">DD</label>
                        <input type="file" class="form-control" id="archivo_dd" name="archivo_dd">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="archivo_ld" class="form-label">LD</label>
                        <input type="file" class="form-control" id="archivo_ld" name="archivo_ld">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="archivo_td" class="form-label">TD</label>
                        <input type="file" class="form-control" id="archivo_td" name="archivo_td">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="archivo_di" class="form-label">DI</label>
                        <input type="file" class="form-control" id="archivo_di" name="archivo_di">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="archivo_li" class="form-label">LI</label>
                        <input type="file" class="form-control" id="archivo_li" name="archivo_li">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="archivo_ti" class="form-label">TI</label>
                        <input type="file" class="form-control" id="archivo_ti" name="archivo_ti">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="archivo_t" class="form-label">T</label>
                        <input type="file" class="form-control" id="archivo_t" name="archivo_t">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>

                    <h4 class="form-label mb-3" style="font-size: 1.2rem; color: var(--dark-color);">Fotografías
                        Adicionales</h4>
                    <div class="form-group">
                        <label for="foto1" class="form-label">Foto1</label>
                        <input type="file" class="form-control" id="foto1" name="foto1">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="foto2" class="form-label">Foto2</label>
                        <input type="file" class="form-control" id="foto2" name="foto2">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="foto3" class="form-label">Foto3</label>
                        <input type="file" class="form-control" id="foto3" name="foto3">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>
                    <div class="form-group">
                        <label for="foto4" class="form-label">Foto4</label>
                        <input type="file" class="form-control" id="foto4" name="foto4">
                        <small class="text-muted">Ningún archivo seleccionado</small>
                    </div>

                    <button type="submit" class="btn-submit">Enviar Reporte</button>
                </form>
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
        // Animación del logo
        const logo = document.querySelector('.logo');
        logo.addEventListener('mouseenter', function() {
            this.style.transform = 'rotate(360deg) scale(1.1)';
        });
        logo.addEventListener('mouseleave', function() {
            this.style.transform = 'rotate(0deg) scale(1)';
        });

        // Función para alternar la expansión de los pasos (si se usa en el futuro)
        function toggleStep(step) {
            const description = step.querySelector('.step-description');
            const allSteps = document.querySelectorAll('.step');

            allSteps.forEach(s => s.classList.remove('active'));
            step.classList.toggle('active');
        }
    </script>
</body>

</html>
