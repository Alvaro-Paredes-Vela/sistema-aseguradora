{{-- Listado de siniestros --}}
@extends('adminlte::page')

@section('title', 'Siniestros Registrados')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-car-crash text-danger"></i> Siniestros
        </h1>
        <a href="{{ route('siniestros.crear') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Registrar Siniestro
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-danger text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-list-alt"></i> Lista de Siniestros Reportados
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
                            <th># Siniestro</th>
                            <th>Fecha / Hora</th>
                            <th>Cliente</th>
                            <th>Placa</th>
                            <th>Ubicación</th>
                            <th class="text-right">Monto Estimado</th>
                            <th>Estado</th>
                            <th>Empleado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siniestros as $siniestro)
                            <tr class="align-middle">
                                <td>
                                    <strong class="text-danger">
                                        {{ $siniestro->numeroSiniestro() }}
                                    </strong>
                                </td>
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($siniestro->fecha)->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $siniestro->hora }}</small>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $siniestro->poliza->vehiculo->cliente->nombre ?? '—' }}
                                            {{ $siniestro->poliza->vehiculo->cliente->paterno ?? '' }}</strong>
                                        <small class="text-muted d-block">CI:
                                            {{ $siniestro->poliza->vehiculo->cliente->CI ?? '' }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary badge-pill px-3 py-2">
                                        {{ $siniestro->poliza->vehiculo->placa }}
                                    </span>
                                </td>
                                <td>
                                    <small>{{ Str::limit($siniestro->ubicacion, 40) }}</small>
                                </td>
                                <td class="text-right font-weight-bold text-danger">
                                    Bs. {{ number_format($siniestro->monto_estimado, 2) }}
                                </td>
                                <td>
                                    @switch($siniestro->estado)
                                        @case('registrado')
                                            <span class="badge badge-warning">Registrado</span>
                                        @break

                                        @case('en_proceso')
                                            <span class="badge badge-info">En Proceso</span>
                                        @break

                                        @case('aprobado')
                                            <span class="badge badge-success">Aprobado</span>
                                        @break

                                        @case('rechazado')
                                            <span class="badge badge-danger">Rechazado</span>
                                        @break

                                        @case('cerrado')
                                            <span class="badge badge-dark">Cerrado</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <small>{{ $siniestro->empleado->nombres ?? '—' }}
                                        {{ $siniestro->empleado->paterno ?? '' }}</small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('siniestros.show', $siniestro->id_siniestro) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fas fa-car-crash fa-3x mb-3 d-block"></i>
                                        <h5>No hay siniestros registrados</h5>
                                        <p>Cuando un cliente reporte un accidente, aparecerá aquí.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {{ $siniestros->links() }}
            </div>
        </div>
    @stop

    @section('css')
        <style>
            .bg-gradient-danger {
                background: linear-gradient(135deg, #dc3545, #c82333);
            }

            .badge-lg {
                font-size: 1.1rem;
                padding: 0.5rem 1rem;
            }
        </style>
    @stop
