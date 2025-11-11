{{-- resources/views/cliente/Comprar-Soat/comprobante.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante SOAT #{{ $poliza->numero_poliza }}</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #1f2937;
            font-size: 10.5pt;
            line-height: 1.4;
            background: white;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 12px;
            background: white;
        }

        /* === LOGO Y NOMBRE PANKEJ (FUNCIONA EN PDF) === */
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 3px double #1e3a8a;
            margin-bottom: 12px;
        }

        /* LOGO: Círculo azul con P blanca */
        .logo {
            width: 60px;
            height: 60px;
            background-color: #1e3a8a;
            /* Azul sólido */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Orbitron', sans-serif;
            font-size: 32pt;
            font-weight: 900;
            text-align: center;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.4);
        }

        .logo span {
            display: block;
            line-height: 1;
        }

        /* NOMBRE: Azul oscuro, sin degradado */
        .company-info h1 {
            margin: 0;
            font-family: 'Orbitron', sans-serif;
            font-size: 20pt;
            font-weight: 900;
            color: #1e3a8a;
            /* Azul sólido */
            text-align: center;
        }

        .company-info p {
            margin: 2px 0 0;
            font-size: 9pt;
            color: #666;
            font-style: italic;
            text-align: center;
        }

        /* === TÍTULO COMPROBANTE === */
        .title {
            text-align: center;
            margin: 10px 0;
            color: #1e3a8a;
        }

        .title h2 {
            margin: 0;
            font-size: 18pt;
            font-weight: 700;
            color: #1e3a8a;
        }

        .title p {
            margin: 4px 0 0;
            font-size: 12pt;
            color: #3b82f6;
        }

        /* === SECCIONES === */
        .section {
            margin-bottom: 10px;
            padding: 10px 12px;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #1e3a8a;
        }

        .section-title {
            font-weight: 700;
            color: #1e3a8a;
            font-size: 12pt;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 12px;
            font-size: 10.5pt;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 6px;
        }

        .info-item i {
            color: #3b82f6;
            font-size: 13pt;
            width: 16px;
            text-align: center;
            margin-top: 1px;
        }

        .info-item strong {
            min-width: 100px;
            color: #1f2937;
            font-weight: 600;
        }

        .highlight {
            background: #1e3a8a;
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 10pt;
            display: inline-block;
        }

        .badge {
            background: #f59e0b;
            color: white;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 9pt;
            font-weight: 700;
        }

        .footer {
            text-align: center;
            margin-top: 12px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
            font-size: 8.5pt;
            color: #666;
        }

        .footer strong {
            color: #1e3a8a;
        }

        @media print {

            body,
            .container {
                margin: 0;
                padding: 8px;
            }

            .section {
                background: #f8fafc !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- LOGO + NOMBRE (100% VISIBLE EN PDF) -->
        <div class="header">

            <div class="company-info">
                <h1>Aseguradora Pankej</h1>
                <p>Seguros y Reaseguros Personales</p>
            </div>
        </div>

        <!-- TÍTULO COMPROBANTE -->
        <div class="title">
            <h2>COMPROBANTE DE PAGO</h2>
            <!--<p>SOAT #{{ $poliza->numero_poliza }}</p>-->
        </div>

        <!-- CLIENTE -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-person-circle"></i> Cliente
            </div>
            <div class="grid">
                <div class="info-item">
                    <i class="bi bi-person"></i>
                    <strong>Nombre:</strong>
                    <span>
                        {{ trim(
                            collect([$venta->cliente->nombre ?? '', $venta->cliente->paterno ?? '', $venta->cliente->materno ?? ''])->filter()->implode(' '),
                        ) ?:
                            '—' }}
                    </span>
                </div>
                <div class="info-item">
                    <i class="bi bi-card-text"></i>
                    <strong>CI:</strong>
                    <span>{{ $venta->cliente->CI ?? '—' }}</span>
                </div>
                <!-- TELÉFONO -->
                <div class="info-item">
                    <i class="bi bi-telephone"></i>
                    <strong>Teléfono:</strong>
                    <span>{{ $venta->cliente->telefono ?? '—' }}</span>
                </div>
            </div>
        </div>

        <!-- VEHÍCULO -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-truck"></i> Vehículo
            </div>
            <div class="grid">
                <div class="info-item">
                    <i class="bi bi-tag"></i>
                    <strong>Placa:</strong>
                    <span>{{ $venta->vehiculo->placa ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-car-front"></i>
                    <strong>Marca:</strong>
                    <span>{{ $venta->vehiculo->marca?->nombre ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-diagram-3"></i>
                    <strong>Modelo:</strong>
                    <span>{{ $venta->vehiculo->modelo?->nombre ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-calendar3"></i>
                    <strong>Año:</strong>
                    <span>{{ $venta->vehiculo->anio_fabricacion ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-gear-wide"></i>
                    <strong>Tipo:</strong>
                    <span>{{ ucfirst($venta->vehiculo->tipo_vehiculo ?? '—') }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-list-ul"></i>
                    <strong>Chasis:</strong>
                    <span>{{ $venta->vehiculo->nro_chasis ?? '—' }}</span>
                </div>
            </div>
        </div>

        <!-- DETALLES -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-receipt"></i> Detalles del Comprobante
            </div>
            <div class="grid">
                <div class="info-item">
                    <i class="bi bi-currency-exchange"></i>
                    <strong>Monto:</strong>
                    <span class="highlight">Bs. {{ number_format($pago->monto) }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-calendar-check"></i>
                    <strong>Emisión:</strong>
                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $poliza->fecha_emision)->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-calendar-x"></i>
                    <strong>Vence:</strong>
                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $poliza->fecha_vencimiento)->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-patch-check"></i>
                    <strong>Estado:</strong>
                    <span class="badge">PAGO CONFIRMADO</span>
                </div>
            </div>
        </div>

        <!-- PIE -->
        <div class="footer">
            <p><strong>Aseguradora Pankej</strong> | Comprobante de Pago SOAT</p>
            <p>Validez nacional | Cobertura: 1 año | Generado: {{ now()->format('d/m/Y H:i') }}</p>
        </div>

    </div>
</body>

</html>
