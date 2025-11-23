{{-- resources/views/empleado/reclamos/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Reclamos de Clientes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-envelope-open-text text-primary"></i> Buzón de Reclamos
        </h1>
        <div>
            <span class="badge badge-danger badge-lg mr-3">
                {{ $reclamos->where('estado', 'pendiente')->count() }} Pendientes
            </span>
            <a href="{{ route('reclamos.create') }}" class="btn btn-outline-success" target="_blank">
                <i class="fas fa-external-link-alt"></i> Ver Formulario Público
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-comments"></i> Todos los Reclamos Recibidos
            </h3>
            <div class="card-tools">
                <span class="text-sm">
                    Total: <strong>{{ $reclamos->total() }}</strong> reclamos
                </span>
            </div>
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
                            <th width="80"># ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Mensaje (extracto)</th>
                            <th>Estado</th>
                            <th>Asignado a</th>
                            <th width="120" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reclamos as $reclamo)
                            <tr class="{{ $reclamo->estado == 'pendiente' ? 'table-warning font-weight-bold' : '' }}">
                                <td class="text-center">
                                    <strong>#{{ $reclamo->id }}</strong>
                                </td>
                                <td>
                                    <div>{{ $reclamo->fecha_reclamo->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $reclamo->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $reclamo->nombre }}</strong>
                                        @if ($reclamo->cliente)
                                            <br><small class="text-success">
                                                <i class="fas fa-check-circle"></i> Cliente registrado
                                            </small>
                                        @else
                                            <br><small class="text-muted">Anónimo</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $reclamo->email }}" class="text-primary">
                                        <i class="fas fa-envelope"></i> {{ Str::limit($reclamo->email, 25) }}
                                    </a>
                                </td>
                                <td>
                                    <div style="max-height:60px; overflow:hidden;">
                                        {{ Str::limit($reclamo->mensaje, 80) }}
                                    </div>
                                </td>
                                <td>
                                    @switch($reclamo->estado)
                                        @case('pendiente')
                                            <span class="badge badge-warning">Pendiente</span>
                                        @break

                                        @case('en_proceso')
                                            <span class="badge badge-info">En Proceso</span>
                                        @break

                                        @case('resuelto')
                                            <span class="badge badge-success">Resuelto</span>
                                        @break

                                        @case('rechazado')
                                            <span class="badge badge-danger">Rechazado</span>
                                        @break

                                        @default
                                            <span class="badge badge-secondary">{{ ucfirst($reclamo->estado) }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if ($reclamo->empleado)
                                        <small>
                                            {{ $reclamo->empleado->nombre }}
                                            {{ $reclamo->empleado->paterno ?? '' }}
                                        </small>
                                    @else
                                        <span class="text-muted">— Sin asignar</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- VER DETALLE -->
                                        <a href="{{ route('reclamos.show', $reclamo) }}" class="btn btn-sm btn-info"
                                            title="Ver detalle">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- EDITAR ESTADO -->
                                        <a href="{{ route('reclamos.edit', $reclamo) }}" class="btn btn-sm btn-warning"
                                            title="Cambiar estado">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-4x mb-3 d-block text-primary"></i>
                                        <h4>No hay reclamos registrados</h4>
                                        <p>¡Todo en orden! No hay quejas pendientes.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer clearfix">
                {{ $reclamos->links() }}
            </div>
        </div>
    @stop

    @section('css')
        <style>
            .bg-gradient-primary {
                background: linear-gradient(135deg, #007bff, #0056b3) !important;
            }

            .badge-lg {
                font-size: 1.1rem;
                padding: 0.6rem 1.2rem;
            }

            .table-warning {
                background-color: #fff3cd !important;
            }
        </style>
    @stop
