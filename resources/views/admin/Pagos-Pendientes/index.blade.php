{{-- resources/views/admin/pagos-pendientes/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Pagos Pendientes - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-clock text-warning"></i> Pagos Pendientes
        </h1>
        <span class="badge badge-danger badge-lg">
            {{ $pagos->count() }} en espera
        </span>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-warning text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-money-check-alt"></i> Verificación de Comprobantes
            </h3>
        </div>

        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible m-3">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible m-3">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Cliente</th>
                            <th>Placa</th>
                            <th class="text-right">Monto</th>
                            <th>Referencia</th>
                            <th>Fecha</th>
                            <th>Comprobante</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagos as $pago)
                            <tr class="align-middle">
                                <td class="text-center">
                                    <strong>#{{ $pago->id_pago }}</strong>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $pago->venta->cliente->nombre ?? '—' }}</strong>
                                        <small class="text-muted d-block">{{ $pago->venta->cliente->ci ?? '' }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary badge-pill px-3 py-2">
                                        {{ $pago->venta->vehiculo->placa }}
                                    </span>
                                </td>
                                <td class="text-right font-weight-bold text-success">
                                    Bs. {{ number_format($pago->monto) }}
                                </td>
                                <td>
                                    <code class="bg-light text-dark px-2 py-1 rounded">{{ $pago->referencia }}</code>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $pago->created_at->format('d/m/Y') }}<br>
                                        {{ $pago->created_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <a href="{{ Storage::url($pago->comprobante) }}" target="_blank"
                                        class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">

                                        <!-- APROBAR -->
                                        <form action="{{ route('admin.pagos-pendientes.aprobar', $pago) }}" method="POST"
                                            style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('¿Confirmar pago y generar póliza?')">
                                                <i class="fas fa-check"></i> Aprobar
                                            </button>
                                        </form>

                                        <!-- RECHAZAR (Modal) -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#rechazarModal{{ $pago->id_pago }}">
                                            <i class="fas fa-times"></i> Rechazar
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL RECHAZAR -->
                            <div class="modal fade" id="rechazarModal{{ $pago->id_pago }}" tabindex="-1">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('admin.pagos-pendientes.rechazar', $pago) }}" method="POST">
                                        @csrf
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-ban"></i> Rechazar Pago #{{ $pago->id_pago }}
                                                </h5>
                                                <button type="button" class="close text-white"
                                                    data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Cliente:</strong> {{ $pago->venta->cliente->nombre }}</p>
                                                <p><strong>Placa:</strong> {{ $pago->venta->vehiculo->placa }}</p>
                                                <div class="form-group mt-3">
                                                    <label class="font-weight-bold">Motivo del rechazo *</label>
                                                    <textarea name="motivo" class="form-control" rows="3" placeholder="Ej: Comprobante ilegible, monto incorrecto..."
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Rechazar Pago
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-check-circle fa-3x mb-3 d-block"></i>
                                    <h5>No hay pagos pendientes</h5>
                                    <p>Todos los comprobantes están procesados.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-center small text-muted">
            <i class="fas fa-info-circle"></i>
            Los pagos aprobados generarán una <strong>póliza SOAT</strong> automáticamente.
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        .badge-lg {
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .btn-sm i {
            font-size: 0.9rem;
        }

        code {
            font-size: 0.85rem;
        }

        .modal-content {
            border-radius: 1rem;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffb300);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Confirmación con SweetAlert para aprobar
        document.querySelectorAll('form button[type="submit"]').forEach(btn => {
            if (btn.innerHTML.includes('Aprobar')) {
                btn.onclick = function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Confirmar pago?',
                        text: "Se generará la póliza SOAT automáticamente",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, aprobar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#28a745'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            btn.closest('form').submit();
                        }
                    });
                };
            }
        });
    </script>
@stop
