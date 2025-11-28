<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precios SOAT - Aseguradora Pankej</title>

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
            --table-bg: #ffffff;
            --table-text: #1e293b;
            --particular-bg: #dbeafe;
            --particular-text: #1e3a8a;
            --public-header-bg: #fbbf24;
            --public-header-text: #1f2937;
            --region-header-bg: #475569;
            --region-header-text: white;
            --santa-cruz-bg: #facc15;
            --santa-cruz-text: #1f2937;
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

        /* === HEADER (100% IGUAL QUE ANTES) === */
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

        /* === SECCIÓN DE PRECIOS === */
        .prices-section {
            flex: 1;
            padding: 4rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .prices-title {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .prices-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .prices-title p {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 700px;
            margin: 0 auto;
        }

        /* === TABLA RESPONSIVE (SOLO ESTA PARTE CAMBIÓ) === */
        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: 0 1rem;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .table-responsive-custom::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive-custom::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .table-responsive-custom::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 10px;
        }

        table {
            min-width: 900px;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--table-bg);
            font-size: 0.95rem;
        }

        th {
            background: var(--primary-color);
            color: white;
            font-weight: 700;
            text-align: center;
            padding: 14px 10px;
            font-size: 0.9rem;
            white-space: nowrap;
            border-bottom: 3px solid #0f172a;
        }

        th:first-child {
            background: #0f172a;
            font-size: 1rem;
            font-weight: 900;
            position: sticky;
            left: 0;
            z-index: 10;
        }

        th.particular {
            background: var(--particular-bg);
            color: var(--particular-text);
            font-weight: 900;
            font-size: 0.95rem;
            position: sticky;
            left: 140px;
            z-index: 10;
        }

        th.public-header {
            background: var(--public-header-bg);
            color: var(--public-header-text);
            font-weight: 900;
            font-size: 0.95rem;
        }

        th.region-header {
            background: var(--region-header-bg);
            color: var(--region-header-text);
            font-weight: 700;
            white-space: nowrap;
        }

        th.region-header.santa-cruz {
            background: var(--santa-cruz-bg);
            color: var(--santa-cruz-text);
            font-weight: 900;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(250, 204, 21, 0.4);
            }

            70% {
                box-shadow: 0 0 0 12px rgba(250, 204, 21, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(250, 204, 21, 0);
            }
        }

        td {
            text-align: center;
            padding: 12px 10px;
            background: #fdfdfd;
            color: var(--table-text);
            font-weight: 600;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        td.vehicle {
            text-align: left;
            font-weight: 700;
            background: #f8fafc;
            color: #1e293b;
            padding-left: 16px;
            font-size: 0.92rem;
            position: sticky;
            left: 0;
            z-index: 5;
            border-left: 5px solid var(--secondary-color);
            min-width: 140px;
        }

        td.particular {
            background: var(--particular-bg);
            color: var(--particular-text);
            font-weight: 700;
            font-size: 0.95rem;
            position: sticky;
            left: 140px;
            z-index: 5;
        }

        .note {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            margin: 1.5rem 1rem 0;
            font-style: italic;
            background: rgba(255, 255, 255, 0.15);
            padding: 12px;
            border-radius: 12px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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

        /* === RESPONSIVE (MÓVIL Y PC) === */
        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
                gap: 1rem;
                padding: 0.5rem;
            }

            .logo-container {
                padding-left: 0;
                justify-content: center;
            }

            .back-button {
                padding-right: 0;
            }

            .btn-back {
                padding: 8px 20px;
                font-size: 0.85rem;
            }

            .prices-title h1 {
                font-size: 1.8rem;
            }

            .prices-title p {
                font-size: 0.9rem;
                padding: 0 1rem;
            }

            .table-responsive-custom {
                margin: 0 0.5rem;
                border-radius: 14px;
            }

            th,
            td {
                padding: 10px 6px;
                font-size: 0.78rem;
            }

            th:first-child,
            td.vehicle {
                min-width: 120px;
                font-size: 0.8rem;
            }

            th.particular,
            td.particular {
                font-size: 0.82rem;
            }

            .note {
                font-size: 0.78rem;
                margin: 1rem 0.5rem;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {

            th,
            td {
                padding: 8px 4px;
                font-size: 0.72rem;
            }

            th:first-child,
            td.vehicle {
                min-width: 100px;
                font-size: 0.75rem;
            }

            /* ================================================================
   TABLA SOAT EN CELULAR – CLARO: PARTICULAR + PÚBLICO (9 deptos)
   ================================================================ */
            @media (max-width: 768px) {
                .table-responsive-custom {
                    overflow-x: hidden !important;
                    margin: 0 0.8rem;
                }

                .table-responsive-custom thead {
                    display: none;
                }

                .table-responsive-custom tr {
                    display: block;
                    background: white;
                    border-radius: 20px;
                    margin-bottom: 2rem;
                    padding: 1.8rem;
                    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
                    border-left: 8px solid var(--secondary-color);
                }

                /* Título del vehículo */
                .table-responsive-custom td.vehicle {
                    display: block !important;
                    text-align: center;
                    font-size: 1.65rem;
                    font-weight: 900;
                    font-family: 'Orbitron', sans-serif;
                    color: var(--primary-color);
                    padding-bottom: 1.4rem !important;
                    margin-bottom: 1.4rem;
                    border-bottom: 5px solid var(--secondary-color);
                }

                .table-responsive-custom td.vehicle::before {
                    content: none;
                }

                /* ================= PARTICULAR ================= */
                .table-responsive-custom td.particular {
                    display: flex !important;
                    justify-content: space-between;
                    background: var(--particular-bg);
                    color: var(--particular-text);
                    font-size: 1.4rem;
                    font-weight: 900;
                    padding: 1.1rem 1.4rem !important;
                    margin: 0 -1.8rem 1.2rem -1.8rem;
                    border-radius: 14px;
                }

                .table-responsive-custom td.particular::before {
                    content: "PARTICULAR";
                    font-size: 1rem;
                }

                /* ================= PÚBLICO (9 departamentos) ================= */
                .table-responsive-custom td:not(.vehicle):not(.particular) {
                    display: flex;
                    justify-content: space-between;
                    padding: 0.95rem 0;
                    border-bottom: 1px solid #f0f0f0;
                    font-size: 1.12rem;
                    font-weight: 600;
                    color: var(--primary-color);
                }

                .table-responsive-custom td:not(.vehicle):not(.particular)::before {
                    content: attr(data-label);
                    font-weight: 700;
                    color: #475569;
                    text-transform: uppercase;
                    font-size: 0.9rem;
                }

                /* Título de la sección PÚBLICO */
                .table-responsive-custom tr::before {
                    content: "PÚBLICO";
                    display: block;
                    background: var(--public-header-bg);
                    color: var(--public-header-text);
                    font-weight: 900;
                    font-size: 1.1rem;
                    text-align: center;
                    padding: 0.8rem;
                    margin: -1.8rem -1.8rem 1.4rem -1.8rem;
                    border-radius: 14px 14px 0 0;
                }

                /* Santa Cruz destacado */
                .table-responsive-custom td[data-label="Santa Cruz"] {
                    background: #fffbeb;
                    color: #92400e;
                    font-weight: 800;
                    border-radius: 12px;
                    padding: 0.9rem 1rem !important;
                }

                .table-responsive-custom td:last-child {
                    border-bottom: none;
                }
            }


        }
    </style>
</head>

<body>
    <!-- Header (100% IGUAL) -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo-container">
                <div class="logo"></div>
                <div>
                    <div class="company-name">Aseguradora Pankej</div>
                    <small class="text-muted">SOAT - Precios Oficiales</small>
                </div>
            </div>
            <div class="back-button">
                <a href="{{ route('home') }}" class="btn btn-back">Volver a Inicio</a>
            </div>
        </div>
    </header>

    <!-- Sección de Precios -->
    <section class="prices-section">
        <div class="container">
            <div class="prices-title">
                <h1>Precios SOAT</h1>
                <p>Desliza horizontalmente en móvil para ver todos los departamentos.</p>
            </div>

            <!-- TABLA RESPONSIVE -->
            <div class="table-responsive-custom">
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">TIPO DE MOTORIZADO</th>
                            <th rowspan="2" class="particular">PARTICULAR</th>
                            <th colspan="9" class="public-header">PÚBLICO</th>
                        </tr>
                        <tr>
                            <th class="region-header">La Paz</th>
                            <th class="region-header">Cochabamba</th>
                            <th class="region-header santa-cruz">Santa Cruz</th>
                            <th class="region-header">Tarija</th>
                            <th class="region-header">Sucre</th>
                            <th class="region-header">Potosí</th>
                            <th class="region-header">Oruro</th>
                            <th class="region-header">Beni</th>
                            <th class="region-header">Pando</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Motocicleta</td>
                            <td class="particular" data-label="Particular">200</td>
                            <td data-label="La Paz">155</td>
                            <td data-label="Cochabamba">155</td>
                            <td data-label="Santa Cruz">155</td>
                            <td data-label="Tarija">155</td>
                            <td data-label="Sucre">155</td>
                            <td data-label="Potosí">155</td>
                            <td data-label="Oruro">155</td>
                            <td data-label="Beni">155</td>
                            <td data-label="Pando">155</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Automóvil</td>
                            <td class="particular" data-label="Particular">90</td>
                            <td data-label="La Paz">120</td>
                            <td data-label="Cochabamba">120</td>
                            <td data-label="Santa Cruz">120</td>
                            <td data-label="Tarija">120</td>
                            <td data-label="Sucre">120</td>
                            <td data-label="Potosí">120</td>
                            <td data-label="Oruro">120</td>
                            <td data-label="Beni">120</td>
                            <td data-label="Pando">120</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Jeep</td>
                            <td class="particular" data-label="Particular">110</td>
                            <td data-label="La Paz">75</td>
                            <td data-label="Cochabamba">75</td>
                            <td data-label="Santa Cruz">75</td>
                            <td data-label="Tarija">75</td>
                            <td data-label="Sucre">75</td>
                            <td data-label="Potosí">75</td>
                            <td data-label="Oruro">75</td>
                            <td data-label="Beni">75</td>
                            <td data-label="Pando">75</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Camioneta</td>
                            <td class="particular" data-label="Particular">140</td>
                            <td data-label="La Paz">190</td>
                            <td data-label="Cochabamba">190</td>
                            <td data-label="Santa Cruz">190</td>
                            <td data-label="Tarija">190</td>
                            <td data-label="Sucre">190</td>
                            <td data-label="Potosí">190</td>
                            <td data-label="Oruro">190</td>
                            <td data-label="Beni">190</td>
                            <td data-label="Pando">190</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Vagoneta</td>
                            <td class="particular" data-label="Particular">90</td>
                            <td data-label="La Paz">125</td>
                            <td data-label="Cochabamba">125</td>
                            <td data-label="Santa Cruz">125</td>
                            <td data-label="Tarija">125</td>
                            <td data-label="Sucre">125</td>
                            <td data-label="Potosí">125</td>
                            <td data-label="Oruro">125</td>
                            <td data-label="Beni">125</td>
                            <td data-label="Pando">125</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Microbús</td>
                            <td class="particular" data-label="Particular">460</td>
                            <td data-label="La Paz">315</td>
                            <td data-label="Cochabamba">315</td>
                            <td data-label="Santa Cruz">315</td>
                            <td data-label="Tarija">315</td>
                            <td data-label="Sucre">315</td>
                            <td data-label="Potosí">315</td>
                            <td data-label="Oruro">315</td>
                            <td data-label="Beni">315</td>
                            <td data-label="Pando">315</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Colectivo</td>
                            <td class="particular" data-label="Particular">595</td>
                            <td data-label="La Paz">335</td>
                            <td data-label="Cochabamba">335</td>
                            <td data-label="Santa Cruz">445</td>
                            <td data-label="Tarija">445</td>
                            <td data-label="Sucre">445</td>
                            <td data-label="Potosí">445</td>
                            <td data-label="Oruro">445</td>
                            <td data-label="Beni">445</td>
                            <td data-label="Pando">445</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Ómnibus/flota<br><small>(Más de 39
                                    ocupantes)</small></td>
                            <td class="particular" data-label="Particular">2.630</td>
                            <td data-label="La Paz">3.700</td>
                            <td data-label="Cochabamba">3.700</td>
                            <td data-label="Santa Cruz">3.700</td>
                            <td data-label="Tarija">3.700</td>
                            <td data-label="Sucre">3.700</td>
                            <td data-label="Potosí">3.700</td>
                            <td data-label="Oruro">3.700</td>
                            <td data-label="Beni">3.700</td>
                            <td data-label="Pando">3.700</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Tracto Camión</td>
                            <td class="particular" data-label="Particular">290</td>
                            <td data-label="La Paz">185</td>
                            <td data-label="Cochabamba">185</td>
                            <td data-label="Santa Cruz">185</td>
                            <td data-label="Tarija">185</td>
                            <td data-label="Sucre">185</td>
                            <td data-label="Potosí">185</td>
                            <td data-label="Oruro">185</td>
                            <td data-label="Beni">185</td>
                            <td data-label="Pando">185</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Minibús<br><small>(8 ocupantes)</small></td>
                            <td class="particular" data-label="Particular">140</td>
                            <td data-label="La Paz">125</td>
                            <td data-label="Cochabamba">125</td>
                            <td data-label="Santa Cruz">125</td>
                            <td data-label="Tarija">125</td>
                            <td data-label="Sucre">125</td>
                            <td data-label="Potosí">125</td>
                            <td data-label="Oruro">125</td>
                            <td data-label="Beni">125</td>
                            <td data-label="Pando">125</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Minibús<br><small>(11 ocupantes)</small></td>
                            <td class="particular" data-label="Particular">200</td>
                            <td data-label="La Paz">190</td>
                            <td data-label="Cochabamba">190</td>
                            <td data-label="Santa Cruz">190</td>
                            <td data-label="Tarija">190</td>
                            <td data-label="Sucre">190</td>
                            <td data-label="Potosí">190</td>
                            <td data-label="Oruro">190</td>
                            <td data-label="Beni">190</td>
                            <td data-label="Pando">190</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Minibús<br><small>(15 ocupantes)</small></td>
                            <td class="particular" data-label="Particular">330</td>
                            <td data-label="La Paz">245</td>
                            <td data-label="Cochabamba">245</td>
                            <td data-label="Santa Cruz">245</td>
                            <td data-label="Tarija">245</td>
                            <td data-label="Sucre">245</td>
                            <td data-label="Potosí">245</td>
                            <td data-label="Oruro">245</td>
                            <td data-label="Beni">245</td>
                            <td data-label="Pando">245</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Camión<br><small>(3 ocupantes)</small></td>
                            <td class="particular" data-label="Particular">330</td>
                            <td data-label="La Paz">195</td>
                            <td data-label="Cochabamba">195</td>
                            <td data-label="Santa Cruz">195</td>
                            <td data-label="Tarija">195</td>
                            <td data-label="Sucre">195</td>
                            <td data-label="Potosí">195</td>
                            <td data-label="Oruro">195</td>
                            <td data-label="Beni">195</td>
                            <td data-label="Pando">195</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Camión<br><small>(18 ocupantes)</small></td>
                            <td class="particular" data-label="Particular">1.020</td>
                            <td data-label="La Paz">975</td>
                            <td data-label="Cochabamba">975</td>
                            <td data-label="Santa Cruz">975</td>
                            <td data-label="Tarija">975</td>
                            <td data-label="Sucre">975</td>
                            <td data-label="Potosí">975</td>
                            <td data-label="Oruro">975</td>
                            <td data-label="Beni">975</td>
                            <td data-label="Pando">975</td>
                        </tr>
                        <tr>
                            <td class="vehicle" data-label="Vehículo">Camión<br><small>(25 ocupantes)</small></td>
                            <td class="particular" data-label="Particular">1.310</td>
                            <td data-label="La Paz">1.260</td>
                            <td data-label="Cochabamba">1.260</td>
                            <td data-label="Santa Cruz">1.260</td>
                            <td data-label="Tarija">1.260</td>
                            <td data-label="Sucre">1.260</td>
                            <td data-label="Potosí">1.260</td>
                            <td data-label="Oruro">1.260</td>
                            <td data-label="Beni">1.260</td>
                            <td data-label="Pando">1.260</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="note">
                Desliza para ver más. Precios en Bolivianos (Bs.). <strong>Santa Cruz</strong> tiene descuento del 2% en
                uso particular y publico.
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Aseguradora Pankej. Todos los derechos reservados. |
                <a href="">Términos</a> | <a href="">Privacidad</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
