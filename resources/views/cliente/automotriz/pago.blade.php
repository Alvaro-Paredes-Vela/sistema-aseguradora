<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Seguro - {{ strtoupper($cotizacion['placa']) }}</title>

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
            --primary: #1e3a8a;
            --secondary: #3b82f6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --light: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            margin: 0;
            padding: 2rem 0;
        }

        .payment-container {
            max-width: 480px;
            margin: 0 auto;
        }

        .card-payment {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.8rem;
            text-align: center;
            position: relative;
        }

        .card-header-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--warning);
        }

        .qr-container {
            background: #f8fafc;
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .qr-box {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            display: inline-block;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: 8px solid var(--warning);
        }

        .qr-box img {
            width: 220px;
            height: 220px;
            border-radius: 8px;
        }

        .info-section {
            padding: 1.8rem;
            background: #f8fafc;
        }

        .info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.7rem 1rem;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary);
        }

        .info-value {
            font-weight: 500;
            color: var(--dark);
            text-transform: uppercase;
        }

        .prima-total {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1.3rem;
            font-weight: 700;
            text-align: center;
            margin: 1rem 0;
            border: 2px solid #f59e0b;
        }

        .upload-section {
            padding: 1.8rem;
            background: white;
        }

        .upload-box {
            border: 2px dashed #94a3b8;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .upload-box:hover {
            border-color: var(--secondary);
            background: #eff6ff;
        }

        .btn-pagar {
            background: var(--success);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 16px 32px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-pagar:hover {
            background: #059669;
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.3);
        }

        .btn-pagar:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .status-pending {
            background: #fff7ed;
            color: #c2410c;
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            border: 1px solid #fed7aa;
            margin-top: 1rem;
        }

        .footer-note {
            font-size: 0.85rem;
            color: #64748b;
            text-align: center;
            margin-top: 1.5rem;
        }

        .ref-code {
            font-family: 'Courier New', monospace;
            background: #e0e7ff;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: bold;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            color: var(--primary);
            font-weight: 900;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="payment-container">

            <!-- TARJETA DE PAGO -->
            <div class="card-payment">

                <!-- HEADER -->
                <div class="card-header-custom">
                    <div class="logo">P</div>
                    <h4 class="mb-0">Pago Seguro Automotriz</h4>
                    <p class="mb-0 mt-2 opacity-90">Placa: <strong>{{ strtoupper($cotizacion['placa']) }}</strong></p>
                </div>

                <!-- QR -->
                <div class="qr-container">
                    <div class="qr-box">
                        <img src="{{ asset('img/qr-banca-movil.jpeg') }}" alt="QR para pago">
                    </div>
                    <p class="mt-3 mb-0">
                        <strong>Escanea con tu app bancaria</strong>
                    </p>
                </div>

                <!-- INFO RESUMEN -->
                <div class="info-section">
                    <div class="info-grid">
                        <div class="info-label">Propietario:</div>
                        <div class="info-value">{{ $cliente->nombre }} {{ $cliente->paterno }}</div>

                        <div class="info-label">CI:</div>
                        <div class="info-value">{{ $cliente->CI }}</div>

                        <div class="info-label">Uso:</div>
                        <div class="info-value">{{ ucfirst($cotizacion['uso_vehiculo']) }}</div>

                        <div class="info-label">Región:</div>
                        <div class="info-value">{{ ucwords(str_replace('_', ' ', $cotizacion['region'])) }}</div>

                        <div class="info-label">Tipo Seguro:</div>
                        <div class="info-value">
                            {{ $cotizacion['tipo_cobertura'] === 'total' ? 'Total' : 'Terceros' }}
                        </div>
                    </div>

                    <div class="prima-total">
                        PRIMA TOTAL: Bs {{ number_format($cotizacion['prima'], 2) }}
                    </div>

                    <p class="text-center mb-0">
                        Referencia: <span class="ref-code">{{ $referencia }}</span>
                    </p>
                </div>

                <!-- SUBIR COMPROBANTE -->
                <div class="upload-section">
                    <form id="formPago" action="{{ route('automotriz.subir-comprobante') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="upload-box">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                            <p class="mb-2"><strong>Sube tu comprobante de pago</strong></p>
                            <input type="file" name="comprobante" id="comprobante" accept="image/*,.pdf" required
                                class="form-control">
                            <small class="text-muted d-block mt-2">Formatos: JPG, PNG, PDF (máx 5MB)</small>
                        </div>

                        <button type="submit" id="btnPagar" class="btn btn-pagar">
                            <i class="fas fa-paper-plane me-2"></i> Ya pagué → Enviar Comprobante
                        </button>

                        <!-- ESTADO DE ESPERA -->
                        <div id="statusPending" class="status-pending" style="display: none;">
                            <i class="fas fa-clock fa-beat me-2"></i>
                            Comprobante enviado. En espera de aprobación...
                        </div>
                    </form>
                </div>

                <!-- NOTA FINAL -->
                <div class="footer-note">
                    <p class="mb-1">
                        <i class="fas fa-shield-alt text-success me-1"></i>
                        Pago seguro vía QR - BCB
                    </p>
                    <p class="mb-0">
                        Apps compatibles: <strong>Tigo Money, Banco Unión, BCP, BNB</strong>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap + JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const form = document.getElementById('formPago');
        const btnPagar = document.getElementById('btnPagar');
        const statusPending = document.getElementById('statusPending');
        const fileInput = document.getElementById('comprobante');

        form.addEventListener('submit', function(e) {
            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Por favor, selecciona tu comprobante de pago.');
                return;
            }

            // Mostrar estado de espera
            btnPagar.disabled = true;
            btnPagar.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Enviando...';
            statusPending.style.display = 'block';
        });
    </script>
</body>

</html>
