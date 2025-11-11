{{-- resources/views/admin/pagos/rechazados.blade.php --}}
@extends('adminlte::page')

@section('title', 'Pagos Rechazados - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-times-circle text-danger"></i> Pagos Rechazados
        </h1>
        <span class="badge badge-warning badge-lg">
            {{ $pagos->count() }} rechazados
        </span>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-danger text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-ban"></i> Motivos de Rechazo
            </h3>
        </div>

        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible m-3">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Placa</th>
                            <th>Monto</th>
                            <th>Referencia</th>
                            <th>Motivo</th>
                            <th>Fecha</th>
                            <th>Comprobante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagos as $pago)
                            <tr class="align-middle">
                                <td><strong>#{{ $pago->id_pago }}</strong></td>
                                <td>
                                    <div>
                                        <strong>{{ $pago->venta->cliente->nombre }}</strong>
                                        <small class="text-muted d-block">{{ $pago->venta->cliente->ci }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary badge-pill px-3 py-2">
                                        {{ $pago->venta->vehiculo->placa }}
                                    </span>
                                </td>
                                <td class="text-right font-weight-bold">
                                    Bs. {{ number_format($pago->monto) }}
                                </td>
                                <td>
                                    <code class="bg-light text-dark px-2 py-1 rounded">{{ $pago->referencia }}</code>
                                </td>
                                <td>
                                    <em class="text-danger small">
                                        {{ Str::limit($pago->motivo_rechazo, 50) }}
                                    </em>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $pago->updated_at->format('d/m/Y') }}<br>
                                        {{ $pago->updated_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    @if ($pago->comprobante && \Storage::disk('public')->exists($pago->comprobante))
                                        <a href="{{ Storage::url($pago->comprobante) }}" target="_blank"
                                            class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    @else
                                        <span class="text-muted">Eliminado</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-check-circle fa-3x mb-3 d-block"></i>
                                    <h5>No hay pagos rechazados</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-center small text-muted">
            <i class="fas fa-info-circle"></i>
            Los comprobantes rechazados se eliminan del almacenamiento.
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
    </style>
@stop
