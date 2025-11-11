<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago QR - {{ $vehiculo->placa }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            max-width: 500px;
            margin: 1rem auto;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: #1e3a8a;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .qr {
            text-align: center;
            padding: 25px;
            background: white;
            border-radius: 16px;
            margin: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 10px solid #f59e0b;
        }

        .qr img {
            width: 100%;
            height: auto;
            max-width: 260px;
            border-radius: 8px;
        }

        .datos {
            background: #f1f5f9;
            padding: 18px;
            border-radius: 14px;
            margin: 20px;
            font-size: 0.95rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.5rem 1rem;
            text-align: left;
            font-size: 0.95rem;
        }

        .info-label {
            font-weight: 600;
            color: #1e3a8a;
        }

        .info-value {
            text-transform: uppercase;
            font-weight: 500;
        }

        .btn-verificar {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 14px 32px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-verificar:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .footer-text {
            font-size: 0.85rem;
            color: #64748b;
        }

        .ref-code {
            font-family: monospace;
            background: #e0e7ff;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Pago SOAT - {{ $vehiculo->placa }}</h4>
            </div>
            <div class="card-body text-center p-4">

                <!-- QR ESTÁTICO PERO FUNCIONAL -->
                <div class="qr">
                    <a href="{{ $pagoUrl }}">
                        <img src="{{ $qrImagePath }}" alt="QR Pago">
                    </a>
                </div>

                <div class="datos">
                    <div class="info-grid mb-3">
                        <div class="info-label">Tipo de Vehículo:</div>
                        <div class="info-value">{{ strtoupper(str_replace('_', ' ', $vehiculo->tipo_vehiculo)) }}</div>

                        <div class="info-label">Tipo de Uso:</div>
                        <div class="info-value">{{ strtoupper($vehiculo->uso_vehiculo) }}</div>

                        <div class="info-label">Departamento:</div>
                        <div class="info-value">{{ strtoupper(str_replace('_', ' ', $vehiculo->region)) }}</div>

                        <div class="info-label">RUAT:</div>
                        <div class="info-value">{{ $RUAT }}</div>

                        <div class="info-label">Prima:</div>
                        <div class="info-value">Bs. {{ number_format($precio) }}</div>
                    </div>

                    <p class="mb-2">Referencia: <span class="ref-code">{{ $referencia }}</span></p>
                    <p class="mb-0">Beneficiario: Seguros SOAT Bolivia</p>
                </div>

                <!-- FORMULARIO -->
                <form action="{{ route('soat.comprar') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <input type="hidden" name="venta_id" value="{{ $venta->id_venta }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Sube tu comprobante de pago:</label>
                        <input type="file" name="comprobante" accept="image/*,application/pdf" required
                            class="form-control">
                        <small class="text-muted">JPG, PNG o PDF</small>
                    </div>

                    <button type="submit" class="btn btn-verificar w-100">
                        Ya pagué → Enviar Comprobante
                    </button>
                </form>

                <p class="footer-text mt-4">
                    Escanea con <strong>Tigo Money, Banco Unión, BCP, BNB</strong> o cualquier app con QR BCB.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
