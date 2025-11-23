@extends('adminlte::page')

@section('title', 'Registrar Siniestro - ' . $poliza->numero_poliza)

@section('content_header')
    <h1 class="m-0">
        <i class="fas fa-car-crash text-danger"></i> Registrar Siniestro
    </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos de la Póliza</h3>
                </div>
                <div class="card-body">
                    <p><strong>N° Póliza:</strong> {{ $poliza->numero_poliza }}</p>
                    <p><strong>Cliente:</strong> {{ $poliza->vehiculo->cliente->nombre }}
                        {{ $poliza->vehiculo->cliente->paterno }}</p>
                    <p><strong>CI:</strong> {{ $poliza->vehiculo->cliente->CI }}</p>
                    <p><strong>Placa:</strong> <span
                            class="badge badge-primary badge-pill">{{ $poliza->vehiculo->placa }}</span></p>
                    <p><strong>Seguro:</strong> {{ $poliza->seguro->nombre ?? 'Automotriz / SOAT' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-danger">
                <div class="card-header bg-gradient-danger text-white">
                    <h3 class="card-title">Formulario de Siniestro</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('siniestros.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_poliza" value="{{ request('poliza_id') ?? $poliza->id_poliza }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha del Siniestro *</label>
                                    <input type="date" name="fecha" class="form-control"
                                        value="{{ old('fecha', today()->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hora *</label>
                                    <input type="time" name="hora" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ubicación *</label>
                            <input type="text" name="ubicacion" class="form-control" maxlength="200"
                                placeholder="Ej: Av. Busch y 3er anillo" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción del Siniestro *</label>
                            <textarea name="descripcion" rows="4" class="form-control" maxlength="450" required
                                placeholder="Detalles del accidente..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Monto Estimado (Bs.) *</label>
                                    <input type="number" step="0.01" name="monto_estimado" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estado Inicial *</label>
                                    <select name="estado" class="form-control" required>
                                        <option value="registrado" selected>Registrado</option>
                                        <option value="en_proceso">En Proceso</option>
                                        <option value="aprobado">Aprobado</option>
                                        <option value="rechazado">Rechazado</option>
                                        <option value="cerrado">Cerrado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Empleado que Registra *</label>
                            <select name="id_empleado" class="form-control" required>
                                @foreach ($empleados as $emp)
                                    <option value="{{ $emp->id_empleado }}">{{ $emp->nombres }} {{ $emp->paterno }}
                                        {{ $emp->materno ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-right mt-4">
                            <a href="{{ route('siniestros.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="fas fa-save"></i> Registrar Siniestro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }
    </style>
@stop
