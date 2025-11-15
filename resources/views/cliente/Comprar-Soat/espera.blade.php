{{-- resources/views/cliente/Comprar-Soat/espera.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificando Pago...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8fafc;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            max-width: 500px;
            margin: auto;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .spinner {
            width: 60px;
            height: 60px;
        }

        .success-icon {
            font-size: 4rem;
            color: #10b981;
        }

        .danger-icon {
            font-size: 4rem;
            color: #ef4444;
        }

        .btn-download {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 14px 32px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-download:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .btn-retry {
            background: #f59e0b;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 14px 32px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-retry:hover {
            background: #d97706;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body text-center p-5">

                @php
                    // ÚLTIMO PAGO (el más reciente)
                    $pago = \App\Models\Pago::where('id_venta', $venta->id_venta)->orderBy('id_pago', 'desc')->first();

                    $poliza = \App\Models\Poliza::where('id_venta', $venta->id_venta)->first();
                @endphp

                @if ($pago && $pago->estado_pago === 'confirmado' && $poliza)
                    <!-- PAGO APROBADO -->
                    <div class="mb-4">
                        <i class="fas fa-check-circle success-icon"></i>
                    </div>
                    <h3 class="text-success mb-3">¡Pago Aprobado!</h3>
                    <p class="text-muted">Tu SOAT ya está activo.</p>
                    <div class="alert alert-success">
                        <strong>Póliza:</strong> #{{ $poliza->numero_poliza }}<br>
                        <strong>Válida hasta:</strong>
                        {{ \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y') }}
                    </div>
                    <a href="{{ route('soat.comprobante', $venta->id_venta) }}" class="btn btn-download w-100">
                        <i class="fas fa-file-pdf"></i> Descargar Póliza PDF
                    </a><br><br>
                    <!-- BOTÓN FACTURA (NUEVO) -->
                    @php
                        $factura = \App\Models\Factura::where('id_pago', $pago->id_pago)->first();
                    @endphp

                    @if ($factura)
                        <a href="{{ route('soat.factura.pdf', $factura->nro_factura) }}" class="btn btn-download w-100">
                            <i class="fas fa-file-pdf"></i> Descargar Factura
                        </a>
                    @endif
                @elseif($pago && $pago->estado_pago === 'rechazado')
                    <!-- PAGO RECHAZADO -->
                    <div class="mb-4">
                        <i class="fas fa-times-circle danger-icon"></i>
                    </div>
                    <h3 class="text-danger mb-3">Pago Rechazado</h3>
                    <div class="alert alert-danger">
                        <strong>Motivo:</strong> {{ $pago->motivo_rechazo ?? 'No especificado' }}
                    </div>

                    <a href="{{ route('soat.qr', $venta->vehiculo->placa) }}?
                        venta_id={{ $venta->id_venta }}
                        &precio={{ $venta->monto_total }}
                        &ruat={{ rawurlencode($venta->vehiculo->RUAT) }}"
                        class="btn btn-retry w-100">
                        <i class="fas fa-redo"></i> Intentar de Nuevo
                    </a>
                @else
                    <!-- ESTADO PENDIENTE O SIN PAGO -->
                    <div class="spinner-border text-primary spinner mb-4" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <h4>Verificando tu pago...</h4>
                    <p class="text-muted">Esto puede tomar hasta 2 minutos.</p>
                    <p class="small text-muted">
                        <strong>Referencia:</strong> {{ $pago->referencia ?? '—' }}
                    </p>
                    <div class="mt-4">
                        <small class="text-muted">
                            Actualizando en <span id="countdown">15</span> segundos...
                        </small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- AUTOREFRESH: SOLO SI ESTÁ PENDIENTE O NO HAY PAGO -->
    @if (!$pago || $pago->estado_pago === 'pendiente')
        <script>
            let seconds = 15;
            const countdown = document.getElementById('countdown');
            const interval = setInterval(() => {
                seconds--;
                if (countdown) {
                    countdown.textContent = seconds;
                }
                if (seconds <= 0) {
                    location.reload();
                }
            }, 1000);

            // Limpia el intervalo al salir
            window.addEventListener('beforeunload', () => clearInterval(interval));
        </script>
    @endif
</body>

</html>
