<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizar SOAT - Paso 2 - Aseguradora Pankej</title>
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
            --success-color: #10b981;
            --gray-color: #6b7280;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }

        /* HEADER EXACTO DE TU HOME */
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
            justify-content: center;
            gap: 1rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 900;
            box-shadow: 0 8px 25px rgba(30, 58, 138, 0.3);
            position: relative;
            overflow: hidden;
        }

        .logo::before {
            content: 'P';
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            z-index: 1;
        }

        .company-name {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-nav .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--secondary-color) !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
            color: white;
        }

        /* STEPPER - EXACTO PASO 1 */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .step-container {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            min-height: 100vh;
            padding-top: 2rem;
        }

        .step-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 20px 20px 0 0;
        }

        .step-number {
            background: var(--gray-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .step-number.active {
            background: var(--accent-color);
        }

        .step-number.completed {
            background: var(--success-color);
        }

        .step-card {
            background: white;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* BOTÓN CONTINUAR - EXACTO PASO 1 */
        .btn-continuar {
            background: var(--success-color);
            border: none;
            border-radius: 50px;
            padding: 15px 40px;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        .btn-continuar:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-volver {
            background: var(--gray-color);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-control,
        .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        /* SECCIONES ESPECÍFICAS PASO 2 */
        .suma-section {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 2px solid var(--secondary-color);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .suma-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .recomendacion {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 2px solid var(--success-color);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            margin: 2rem 0;
        }

        .recomendacion-title {
            font-weight: 700;
            color: var(--success-color);
            font-size: 1.2rem;
        }

        .paquetes-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .paquetes-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .paquete-item {
            border: 2px solid #e5e7eb;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .paquete-item:hover {
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .paquete-item.active {
            border-color: var(--success-color);
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
        }

        .paquete-km {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .paquete-precio {
            font-weight: 700;
            color: var(--success-color);
            font-size: 1.3rem;
        }

        footer {
            background: var(--dark-color);
            color: white;
        }
    </style>
</head>

<body>
    <!-- HEADER EXACTO DE TU HOME -->
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="logo-container">
                        <div class="logo"></div>
                        <div>
                            <div class="company-name">Aseguradora Pankej</div>
                            <small class="text-muted">Seguros y Reaseguros Personales</small>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link active" href="/cotizar">Cotizar</a></li>
                            <li class="nav-item"><a class="nav-link" href="#precios">Precios</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contacto">Contáctanos</a></li>
                            <li class="nav-item">
                                <a class="btn btn-primary-custom btn-sm ms-2" href="{{ route('register.cliente') }}">
                                    <i class="fas fa-user-shield me-1"></i>Registrarme
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- PASO 2 - EXACTO ESTILO PASO 1 -->
    <section class="step-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- STEPPER - EXACTO PASO 1 -->
                    <div class="step-header py-4">
                        <div class="text-center">
                            <div><i class="fas fa-calculator me-2"></i>Cotizador SOAT</div>
                            <div class="d-flex justify-content-center gap-3 mt-2">
                                <span class="step-number completed">1</span>
                                <span class="step-number active">2</span>
                                <span class="step-number">3</span>
                            </div>
                        </div>
                    </div>

                    <div class="step-card p-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-volver" onclick="history.back()">
                                <i class="fas fa-arrow-left me-2"></i>VOLVER
                            </button>
                            <h4 class="mb-0"><i class="fas fa-car me-2"></i>Datos del Vehículo</h4>
                        </div>

                        <form method="POST" action="{{ route('cotizar.paso3') }}">
                            @csrf

                            {{-- DATOS CLIENTE --}}
                            @foreach ($datosCliente as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach

                            <!-- SUMA ASEGURADA -->
                            <div class="suma-section">
                                <div class="form-label">Suma asegurada</div>
                                <div class="suma-value">Bs 27.500</div>
                            </div>

                            <!-- 4 CAMPOS VEHÍCULO -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Tipo de vehículo</label>
                                    <select class="form-select" name="tipo_vehiculo" id="tipo_vehiculo"
                                        onchange="calcularPrecio()" required>
                                        <option value="Automóvil">Automóvil</option>
                                        <option value="Camioneta">Camioneta</option>
                                        <option value="Moto">Motocicleta</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Marca vehículo</label>
                                    <select class="form-select" name="marca" id="marca"
                                        onchange="calcularPrecio()" required>
                                        <option value="Chevrolet">Chevrolet</option>
                                        <option value="Toyota">Toyota</option>
                                        <option value="Hyundai">Hyundai</option>
                                        <option value="Suzuki">Suzuki</option>
                                        <option value="Acura">Acura</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Año de vehículo</label>
                                    <input type="number" class="form-control" name="anio" id="anio"
                                        min="2010" max="2025" onchange="calcularPrecio()" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Regional</label>
                                    <select class="form-select" name="procedencia" id="procedencia"
                                        onchange="calcularPrecio()" required>
                                        <option value="SC">Santa Cruz</option>
                                        <option value="LP">La Paz</option>
                                        <option value="CBBA">Cochabamba</option>
                                    </select>
                                </div>
                            </div>

                            <!-- RECOMENDACIÓN -->
                            <div class="recomendacion">
                                <div class="recomendacion-title">SE RECOMIENDA</div>
                                <div class="fw-bold fs-4">Auto x Kilómetro</div>
                            </div>

                            <!-- PAQUETES -->
                            <div class="paquetes-header">
                                <span>Paquete Km</span>
                                <span>Prima total</span>
                            </div>
                            <div class="paquetes-grid">
                                <div class="paquete-item active" onclick="seleccionarPaquete(2500)">
                                    <input type="radio" name="paquete_km" value="2500" id="km2500" checked>
                                    <div class="paquete-km">2.500 km</div>
                                    <div class="paquete-precio" data-precio="380.00">Bs 380,00</div>
                                </div>
                                <div class="paquete-item" onclick="seleccionarPaquete(5000)">
                                    <input type="radio" name="paquete_km" value="5000" id="km5000">
                                    <div class="paquete-km">5.000 km</div>
                                    <div class="paquete-precio" data-precio="474.82">Bs 474,82</div>
                                </div>
                                <div class="paquete-item" onclick="seleccionarPaquete(7500)">
                                    <input type="radio" name="paquete_km" value="7500" id="km7500">
                                    <div class="paquete-km">7.500 km</div>
                                    <div class="paquete-precio" data-precio="587.46">Bs 587,46</div>
                                </div>
                                <div class="paquete-item" onclick="seleccionarPaquete(10000)">
                                    <input type="radio" name="paquete_km" value="10000" id="km10000">
                                    <div class="paquete-km">10.000 km</div>
                                    <div class="paquete-precio" data-precio="699.87">Bs 699,87</div>
                                </div>
                            </div>

                            <!-- BOTÓN CONTINUAR -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-continuar">
                                    <i class="fas fa-arrow-right me-2"></i>CONTINUAR
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Aseguradora Pankej. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function seleccionarPaquete(km) {
            document.querySelectorAll('input[name="paquete_km"]').forEach(r => r.checked = false);
            document.getElementById('km' + km).checked = true;
            document.querySelectorAll('.paquete-item').forEach(i => i.classList.remove('active'));
            event.target.closest('.paquete-item').classList.add('active');
            calcularPrecio();
        }

        function calcularPrecio() {
            const tipo = document.getElementById('tipo_vehiculo').value;
            const anio = parseInt(document.getElementById('anio').value) || 2020;
            const marca = document.getElementById('marca').value;
            const regional = document.getElementById('procedencia').value;

            let precios = [380.00, 474.82, 587.46, 699.87];

            if (tipo === 'Moto') precios = [250.00, 320.00, 400.00, 480.00];
            else if (tipo === 'Camioneta') precios = [420.00, 520.00, 650.00, 780.00];

            if (anio >= 2023) precios = precios.map(p => p * 1.1);
            if (anio <= 2015) precios = precios.map(p => p * 0.9);

            const regionalMultiplicador = {
                'SC': 1.0,
                'LP': 1.05,
                'CBBA': 1.02
            };
            precios = precios.map(p => p * regionalMultiplicador[regional]);

            const kms = [2500, 5000, 7500, 10000];
            kms.forEach((km, index) => {
                const elemento = document.querySelector(`#km${km}`).closest('.paquete-item').querySelector(
                    '.paquete-precio');
                elemento.innerHTML = `Bs ${precios[index].toFixed(2).replace('.', ',')}`;
                elemento.setAttribute('data-precio', precios[index]);
            });
        }

        document.addEventListener('DOMContentLoaded', calcularPrecio);
    </script>
</body>

</html>
