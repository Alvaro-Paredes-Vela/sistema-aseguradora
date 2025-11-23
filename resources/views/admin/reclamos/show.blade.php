{{-- resources/views/empleado/reclamos/show.blade.php --}}
@extends('adminlte::page')

@section('title', 'Reclamo #' . $reclamo->id)

@section('content_header')
    <h1 class="m-0">
        <i class="fas fa-comment-medical text-info"></i> Reclamo #{{ $reclamo->id }}
    </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Mensaje del Cliente</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Nombre:</th>
                            <td><strong>{{ $reclamo->nombre }}</strong></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>
                                <a href="mailto:{{ $reclamo->email }}" class="text-primary">
                                    <i class="fas fa-envelope"></i> {{ $reclamo->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha:</th>
                            <td>{{ $reclamo->fecha_reclamo->format('d/m/Y') }} a las
                                {{ $reclamo->created_at->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
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
                                @endswitch
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <h5>Mensaje:</h5>
                    <div class="bg-light p-4 rounded">
                        {!! nl2br(e($reclamo->mensaje)) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Acciones</h3>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('reclamos.edit', $reclamo) }}" class="btn btn-warning btn-block mb-2">
                        <i class="fas fa-edit"></i> Cambiar Estado
                    </a>
                    <a href="mailto:{{ $reclamo->email }}?subject=Re:%20Reclamo%20#{{ $reclamo->id }}"
                        class="btn btn-success btn-block mb-2">
                        <i class="fas fa-reply"></i> Responder por Email
                    </a>
                    <a href="{{ route('reclamos.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left"></i> Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
