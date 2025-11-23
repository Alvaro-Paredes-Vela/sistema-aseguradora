{{-- resources/views/empleado/reclamos/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Reclamo #' . $reclamo->id)

@section('content_header')
    <h1 class="m-0">
        <i class="fas fa-tasks text-warning"></i> Gestionar Reclamo #{{ $reclamo->id }}
    </h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Actualizar Estado del Reclamo</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('reclamos.update', $reclamo) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="form-group">
                            <label>Estado actual</label>
                            <h4>
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
                            </h4>
                        </div>

                        <div class="form-group">
                            <label>Nuevo estado</label>
                            <select name="estado" class="form-control form-control-lg" required>
                                <option value="pendiente" {{ $reclamo->estado == 'pendiente' ? 'selected' : '' }}>Pendiente
                                </option>
                                <option value="en_proceso" {{ $reclamo->estado == 'en_proceso' ? 'selected' : '' }}>En
                                    Proceso</option>
                                <option value="resuelto" {{ $reclamo->estado == 'resuelto' ? 'selected' : '' }}>Resuelto
                                </option>
                                <option value="rechazado" {{ $reclamo->estado == 'rechazado' ? 'selected' : '' }}>Rechazado
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Asignar a empleado</label>
                            <select name="id_empleado" class="form-control">
                                <option value="">-- Sin asignar --</option>
                                @foreach (\App\Models\Empleado::all() as $emp)
                                    <option value="{{ $emp->id_empleado }}"
                                        {{ $reclamo->id_empleado == $emp->id_empleado ? 'selected' : '' }}>
                                        {{ $emp->nombres }} {{ $emp->paterno }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('reclamos.index') }}" class="btn btn-secondary btn-lg mr-3">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="fas fa-save"></i> Actualizar Estado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
