<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo - Paso 1</title>

    <!-- Bootstrap 5 -->
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
            --success-color: #10b981;
            --gray-color: #6b7280;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
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
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
            padding: 1.5rem;
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
            font-size: 1.1rem;
        }

        .step-number.active {
            background: var(--accent-color);
        }

        .step-card {
            background: white;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
        }

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

        footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
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
                </div>
            </nav>
        </div>
    </header>

    <!-- PASO 1 -->
    <section class="step-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- STEPPER -->
                    <div class="step-header text-center">
                        <div>Cotizador Seguro Automotriz</div>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <span class="step-number active">1</span>
                            <span class="step-number">2</span>
                            <span class="step-number">3</span>
                        </div>
                    </div>

                    <!-- FORMULARIO -->
                    <div class="step-card">
                        <h4 class="text-center mb-4">Registro Básico del Vehículo</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('automotriz.guardar-paso1') }}" method="POST">
                            @csrf

                            <!-- REGISTRO DEL PROPIETARIO (6 CAMPOS) -->
                            <div class="card border-primary mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Datos del Propietario</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" name="nombre" class="form-control" required
                                                value="{{ old('nombre') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Paterno <span class="text-danger">*</span></label>
                                            <input type="text" name="paterno" class="form-control" required
                                                value="{{ old('paterno') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Materno</label>
                                            <input type="text" name="materno" class="form-control"
                                                value="{{ old('materno') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">CI <span class="text-danger">*</span></label>
                                            <input type="text" name="CI" class="form-control" required
                                                value="{{ old('CI') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Correo <span class="text-danger">*</span></label>
                                            <input type="email" name="correo" class="form-control" required
                                                value="{{ old('correo') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Teléfono <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="telefono" class="form-control" required
                                                value="{{ old('telefono') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CAMPOS DEL VEHÍCULO -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Placa <span class="text-danger">*</span></label>
                                    <input type="text" name="placa" class="form-control text-uppercase"
                                        placeholder="Ej: 123ABC" required maxlength="10" value="{{ old('placa') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Valor Comercial (Bs) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="valor_comercial" class="form-control"
                                        placeholder="50000" required min="10000" max="1000000"
                                        value="{{ old('valor_comercial') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Uso del Vehículo <span
                                            class="text-danger">*</span></label>
                                    <select name="uso_vehiculo" class="form-select" required>
                                        <option value="particular"
                                            {{ old('uso_vehiculo') == 'particular' ? 'selected' : '' }}>Particular
                                        </option>
                                        <option value="publico"
                                            {{ old('uso_vehiculo') == 'publico' ? 'selected' : '' }}>Público</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Región <span class="text-danger">*</span></label>
                                    <select name="region" class="form-select" required>
                                        @foreach (['santa_cruz', 'la_paz', 'cochabamba', 'oruro', 'potosi', 'beni', 'pando', 'chuquisaca', 'tarija'] as $reg)
                                            <option value="{{ $reg }}"
                                                {{ old('region') == $reg ? 'selected' : '' }}>
                                                {{ ucwords(str_replace('_', ' ', $reg)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Tipo de Seguro <span
                                            class="text-danger">*</span></label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-check p-3 border rounded text-center">
                                                <input class="form-check-input" type="radio" name="seguro"
                                                    value="total" id="total"
                                                    {{ old('seguro', 'total') == 'total' ? 'checked' : '' }} required>
                                                <label class="form-check-label d-block" for="total">
                                                    <strong class="d-block">Seguro Total</strong>
                                                    <small class="text-muted">Cubre propietario + terceros</small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check p-3 border rounded text-center">
                                                <input class="form-check-input" type="radio" name="seguro"
                                                    value="terceros" id="terceros"
                                                    {{ old('seguro') == 'terceros' ? 'checked' : '' }} required>
                                                <label class="form-check-label d-block" for="terceros">
                                                    <strong class="d-block">Seguro a Terceros</strong>
                                                    <small class="text-muted">Solo cubre al afectado</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-continuar">
                                    Cotizar Prima
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p>© 2025 Aseguradora Pankej. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript para ## User Info -->
    <script>
        function updateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
                timeZone: 'America/La_Paz'
            };
            const formatted = now.toLocaleDateString('es-BO', options).replace(',', '') + ' -04';
            document.getElementById('current-time').textContent = formatted;
        }

        updateTime();
        setInterval(updateTime, 1000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
