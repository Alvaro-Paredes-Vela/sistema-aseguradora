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

        /* HEADER */
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
        }

        .logo::before {
            content: 'P';
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 900;
        }

        .company-name {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
            transition: all 0.3s;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
        }

        .prices-section {
            flex: 1;
            padding: 4rem 0;
        }

        .prices-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            color: white;
            font-size: 2.3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        /* ========= TABLA SOLO EN ESCRITORIO ========= */
        @media (min-width: 769px) {
            .table-responsive-custom {
                display: block !important;
            }

            .mobile-cards {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .table-responsive-custom {
                display: none !important;
            }

            .mobile-cards {
                display: block !important;
            }
        }

        /* TABLA ESCRITORIO */
        .table-responsive-custom {
            overflow-x: auto;
            margin: 0 1rem;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        table {
            min-width: 900px;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
        }

        th {
            background: var(--primary-color);
            color: white;
            padding: 14px 10px;
            text-align: center;
            font-weight: 700;
            white-space: nowrap;
        }

        th:first-child {
            background: #0f172a;
            position: sticky;
            left: 0;
            z-index: 10;
        }

        th.particular {
            background: var(--particular-bg);
            color: var(--particular-text);
            position: sticky;
            left: 140px;
            z-index: 10;
        }

        th.public-header {
            background: var(--public-header-bg);
            color: var(--public-header-text);
        }

        th.region-header.santa-cruz {
            background: var(--santa-cruz-bg);
            color: var(--santa-cruz-text);
            animation: pulse 2s infinite;
        }

        td {
            text-align: center;
            padding: 12px 10px;
            background: #fdfdfd;
            border-bottom: 1px solid #e2e8f0;
        }

        td.vehicle {
            position: sticky;
            left: 0;
            z-index: 5;
            background: #f8fafc;
            text-align: left;
            padding-left: 16px;
            font-weight: 700;
            border-left: 5px solid var(--secondary-color);
        }

        td.particular {
            position: sticky;
            left: 140px;
            z-index: 5;
            background: var(--particular-bg);
            color: var(--particular-text);
            font-weight: 700;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(250, 204, 21, 0.4);
            }

            70% {
                box-shadow: 0 0 0 12px rgba(250, 204, 21, 0);
            }
        }

        /* ========= TARJETAS MÓVIL ========= */
        .mobile-cards {
            padding: 0 1rem;
        }

        .vehicle-card {
            background: white;
            border-radius: 18px;
            margin-bottom: 1.5rem;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
            border-left: 8px solid var(--secondary-color);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.3rem;
            text-align: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.4rem;
            font-weight: 900;
        }

        .prices-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1px;
            background: #eee;
        }

        .price-item {
            padding: 1rem;
            text-align: center;
            background: white;
        }

        .price-item.particular {
            grid-column: 1 / -1;
            background: var(--particular-bg) !important;
            color: var(--particular-text);
            font-weight: 900;
            font-size: 1.3rem;
        }

        .price-label {
            font-size: 0.85rem;
            color: #555;
            text-transform: uppercase;
            font-weight: 700;
            display: block;
            margin-bottom: 4px;
        }

        .price-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .santa-cruz-price {
            background: #fffbeb !important;
            color: #92400e;
        }

        .note {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            margin: 2rem 1rem 0;
            padding: 15px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            margin-top: auto;
        }

        @media (max-width: 576px) {

            /* 1. Header más corto y compacto */
            .header {
                padding: 0.6rem 0 !important;
                position: relative;
                /* ya no sticky para que no tape */
            }

            .header .container {
                flex-direction: column;
                gap: 0.5rem;
                padding: 0.5rem 1rem;
            }

            /* 2. Logo + nombre arriba, centrado */
            .logo-container {
                padding-left: 0 !important;
                justify-content: center;
                gap: 0.8rem;
            }

            .company-name {
                font-size: 1.35rem !important;
            }

            .company-subtitle {
                font-size: 0.7rem !important;
            }

            /* 3. Los dos botones en una sola fila horizontal, pero más pequeños y con espacio */
            .back-button {
                display: flex !important;
                gap: 0.8rem !important;
                justify-content: center;
                width: 100%;
                flex-wrap: nowrap !important;
            }

            .back-button a.btn-soat {
                flex: 1;
                /* ocupan el espacio disponible */
                max-width: 48%;
                /* nunca se salen */
                padding: 0.65rem 0.4rem !important;
                font-size: 0.85rem !important;
                white-space: nowrap;
                text-align: center;
            }

            /* 4. El contenido principal empieza más arriba (no queda tapado) */
            .guide-section {
                padding-top: 2rem !important;
                /* ← menos espacio arriba */
            }

            .guide-title h1 {
                font-size: 2rem !important;
            }

            .steps-container {
                padding: 0 1rem;
            }
        }

        /* Para celulares muy pequeños */
        @media (max-width: 380px) {
            .back-button {
                flex-direction: column !important;
                gap: 0.5rem;
            }

            .back-button a.btn-soat {
                max-width: 100%;
                font-size: 0.9rem;
                padding: 0.75rem !important;
            }
        }
    </style>
</head>

<body>
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

    <section class="prices-section">
        <div class="container">
            <div class="prices-title">
                <h1>Precios SOAT</h1>
            </div>

            <!-- TABLA ORIGINAL (se ve en PC y tablets) -->
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
                            <td class="vehicle">Motocicleta</td>
                            <td class="particular">200</td>
                            <td>155</td>
                            <td>155</td>
                            <td>155</td>
                            <td>155</td>
                            <td>155</td>
                            <td>155</td>
                            <td>155</td>
                            <td>155</td>
                            <td>155</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Automóvil</td>
                            <td class="particular">90</td>
                            <td>120</td>
                            <td>120</td>
                            <td>120</td>
                            <td>120</td>
                            <td>120</td>
                            <td>120</td>
                            <td>120</td>
                            <td>120</td>
                            <td>120</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Jeep</td>
                            <td class="particular">110</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Camioneta</td>
                            <td class="particular">140</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Vagoneta</td>
                            <td class="particular">90</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Microbús</td>
                            <td class="particular">460</td>
                            <td>315</td>
                            <td>315</td>
                            <td>315</td>
                            <td>315</td>
                            <td>315</td>
                            <td>315</td>
                            <td>315</td>
                            <td>315</td>
                            <td>315</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Colectivo</td>
                            <td class="particular">595</td>
                            <td>335</td>
                            <td>335</td>
                            <td>445</td>
                            <td>445</td>
                            <td>445</td>
                            <td>445</td>
                            <td>445</td>
                            <td>445</td>
                            <td>445</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Ómnibus/flota<br><small>(Más de 39 ocupantes)</small></td>
                            <td class="particular">2.630</td>
                            <td>3.700</td>
                            <td>3.700</td>
                            <td>3.700</td>
                            <td>3.700</td>
                            <td>3.700</td>
                            <td>3.700</td>
                            <td>3.700</td>
                            <td>3.700</td>
                            <td>3.700</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Tracto Camión</td>
                            <td class="particular">290</td>
                            <td>185</td>
                            <td>185</td>
                            <td>185</td>
                            <td>185</td>
                            <td>185</td>
                            <td>185</td>
                            <td>185</td>
                            <td>185</td>
                            <td>185</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Minibús<br><small>(8 ocupantes)</small></td>
                            <td class="particular">140</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                            <td>125</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Minibús<br><small>(11 ocupantes)</small></td>
                            <td class="particular">200</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                            <td>190</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Minibús<br><small>(15 ocupantes)</small></td>
                            <td class="particular">330</td>
                            <td>245</td>
                            <td>245</td>
                            <td>245</td>
                            <td>245</td>
                            <td>245</td>
                            <td>245</td>
                            <td>245</td>
                            <td>245</td>
                            <td>245</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Camión<br><small>(3 ocupantes)</small></td>
                            <td class="particular">330</td>
                            <td>195</td>
                            <td>195</td>
                            <td>195</td>
                            <td>195</td>
                            <td>195</td>
                            <td>195</td>
                            <td>195</td>
                            <td>195</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Camión<br><small>(18 ocupantes)</small></td>
                            <td class="particular">1.020</td>
                            <td>975</td>
                            <td>975</td>
                            <td>975</td>
                            <td>975</td>
                            <td>975</td>
                            <td>975</td>
                            <td>975</td>
                            <td>975</td>
                            <td>975</td>
                        </tr>
                        <tr>
                            <td class="vehicle">Camión<br><small>(25 ocupantes)</small></td>
                            <td class="particular">1.310</td>
                            <td>1.260</td>
                            <td>1.260</td>
                            <td>1.260</td>
                            <td>1.260</td>
                            <td>1.260</td>
                            <td>1.260</td>
                            <td>1.260</td>
                            <td>1.260</td>
                            <td>1.260</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- TARJETAS SOLO EN MÓVIL (las 15 completas) -->
            <div class="mobile-cards" style="display:none;">
                <!-- 1. Motocicleta -->
                <div class="vehicle-card">
                    <div class="card-header">Motocicleta</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">200 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">155
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span class="price-value">155
                                Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">155 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">155
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">155
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">155
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">155
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">155
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">155
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 2. Automóvil -->
                <div class="vehicle-card">
                    <div class="card-header">Automóvil</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">90 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">120
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">120 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">120 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">120
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">120
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">120
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">120
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">120
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">120
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 3. Jeep -->
                <div class="vehicle-card">
                    <div class="card-header">Jeep</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">110 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">75
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">75 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">75 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">75
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">75
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">75
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">75
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">75
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">75
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 4. Camioneta -->
                <div class="vehicle-card">
                    <div class="card-header">Camioneta</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">140 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">190 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">190 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">190
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 5. Vagoneta -->
                <div class="vehicle-card">
                    <div class="card-header">Vagoneta</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">90 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">125 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">125 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">125
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 6. Microbús -->
                <div class="vehicle-card">
                    <div class="card-header">Microbús</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">460 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">315
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">315 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">315 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">315
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">315
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">315
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">315
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">315
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">315
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 7. Colectivo -->
                <div class="vehicle-card">
                    <div class="card-header">Colectivo</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">595 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">335
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">335 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">445 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">445
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">445
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">445
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">445
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">445
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">445
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 8. Ómnibus/flota -->
                <div class="vehicle-card">
                    <div class="card-header">Ómnibus/flota<br><small>(Más de 39 ocupantes)</small></div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">2.630 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span
                                class="price-value">3.700 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">3.700 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">3.700 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span
                                class="price-value">3.700 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">3.700
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span
                                class="price-value">3.700 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">3.700
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">3.700
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">3.700
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 9. Tracto Camión -->
                <div class="vehicle-card">
                    <div class="card-header">Tracto Camión</div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">290 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">185
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">185 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">185 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">185
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">185
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">185
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">185
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">185
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">185
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 10. Minibús 8 ocupantes -->
                <div class="vehicle-card">
                    <div class="card-header">Minibús<br><small>(8 ocupantes)</small></div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">140 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">125 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">125 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">125
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">125
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 11. Minibús 11 ocupantes -->
                <div class="vehicle-card">
                    <div class="card-header">Minibús<br><small>(11 ocupantes)</small></div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">200 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">190 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">190 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">190
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">190
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 12. Minibús 15 ocupantes -->
                <div class="vehicle-card">
                    <div class="card-header">Minibús<br><small>(15 ocupantes)</small></div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">330 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">245
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">245 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">245 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">245
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">245
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">245
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">245
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">245
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">245
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 13. Camión 3 ocupantes -->
                <div class="vehicle-card">
                    <div class="card-header">Camión<br><small>(3 ocupantes)</small></div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">330 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">195
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">195 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">195 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">195
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">195
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">195
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">195
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">195
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">195
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 14. Camión 18 ocupantes -->
                <div class="vehicle-card">
                    <div class="card-header">Camión<br><small>(18 ocupantes)</small></div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">1.020 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span class="price-value">975
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">975 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">975 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span class="price-value">975
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">975
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span class="price-value">975
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">975
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">975
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">975
                                Bs.</span></div>
                    </div>
                </div>

                <!-- 15. Camión 25 ocupantes -->
                <div class="vehicle-card">
                    <div class="card-header">Camión<br><small>(25 ocupantes)</small></div>
                    <div class="prices-grid">
                        <div class="price-item particular"><span class="price-label">PARTICULAR</span><span
                                class="price-value">1.310 Bs.</span></div>
                        <div class="price-item"><span class="price-label">La Paz</span><span
                                class="price-value">1.260 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Cochabamba</span><span
                                class="price-value">1.260 Bs.</span></div>
                        <div class="price-item santa-cruz-price"><span class="price-label">Santa Cruz</span><span
                                class="price-value">1.260 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Tarija</span><span
                                class="price-value">1.260 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Sucre</span><span class="price-value">1.260
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Potosí</span><span
                                class="price-value">1.260 Bs.</span></div>
                        <div class="price-item"><span class="price-label">Oruro</span><span class="price-value">1.260
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Beni</span><span class="price-value">1.260
                                Bs.</span></div>
                        <div class="price-item"><span class="price-label">Pando</span><span class="price-value">1.260
                                Bs.</span></div>
                    </div>
                </div>
            </div>

            <div class="note">
                Precios en Bolivianos (Bs.). <strong>Santa Cruz</strong> tiene descuento del 2% en uso particular y
                público.
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>© 2025 Aseguradora Pankej. Todos los derechos reservados. |
                <a href="">Términos</a> | <a href="">Privacidad</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
