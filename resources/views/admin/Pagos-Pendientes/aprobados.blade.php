{{-- resources/views/admin/pagos/aprobados.blade.php --}}
@extends('adminlte::page')

@section('title', 'Pagos Aprobados - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-check-circle text-success"></i> Pagos Aprobados
        </h1>
        <span class="badge badge-success badge-lg">
            {{ $pagos->count() }} emitidos
        </span>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-file-invoice-dollar"></i> Pólizas Emitidas
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
                            <th>Póliza</th>
                            <th>Aprobado por</th>
                            <th>Fecha</th>
                            <th>Comprobante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagos as $pago)
                            @php
                                $poliza = \App\Models\Poliza::where('id_venta', $pago->id_venta)->first();
                            @endphp
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
                                <td class="text-right font-weight-bold text-success">
                                    Bs. {{ number_format($pago->monto) }}
                                </td>
                                <td>
                                    <code class="bg-light text-dark px-2 py-1 rounded">{{ $pago->referencia }}</code>
                                </td>
                                <td>
                                    @if ($poliza)
                                        <span class="badge badge-success">
                                            #{{ $poliza->numero_poliza }}
                                        </span>
                                    @else
                                        <em class="text-muted">Sin póliza</em>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-success">
                                        {{ $pago->confirmadoPor?->nombre ?? '—' }}
                                    </small>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $pago->updated_at->format('d/m/Y') }}<br>
                                        {{ $pago->updated_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <a href="{{ Storage::url($pago->comprobante) }}" target="_blank"
                                        class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fas fa-check-circle fa-3x mb-3 d-block"></i>
                                    <h5>No hay pagos aprobados</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-center small text-muted">
            <i class="fas fa-info-circle"></i>
            Estas pólizas están activas y disponibles para el cliente.
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
