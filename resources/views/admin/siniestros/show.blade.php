@extends('adminlte::page')

@section('title', 'Siniestro ' . $siniestro->numeroSiniestro())

@section('content_header')
    <h1 class="m-0">
        <i class="fas fa-file-alt text-danger"></i> Detalle del Siniestro
    </h1>
@stop

@section('content')
    <div class="card card-danger">
        <div class="card-header bg-gradient-danger text-white">
            <h3 class="card-title">#{{ $siniestro->numeroSiniestro() }}</h3>
            <div class="card-tools">
                <a href="{{ route('siniestros.index') }}" class="btn btn-secondary btn-lg">
                    <!--- color del boton plomo --->
                    <i class="fas fa-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($siniestro->fecha)->format('d/m/Y') }}</p>
                    <p><strong>Hora:</strong> {{ $siniestro->hora }}</p>
                    <p><strong>Ubicación:</strong> {{ $siniestro->ubicacion }}</p>
                    <p><strong>Monto Estimado:</strong> <span class="text-danger font-weight-bold">Bs.
                            {{ number_format($siniestro->monto_estimado, 2) }}</span></p>
                    <p><strong>Estado:</strong>
                        <span
                            class="badge badge-lg {{ $siniestro->estado == 'aprobado' ? 'badge-success' : ($siniestro->estado == 'rechazado' ? 'badge-danger' : 'badge-warning') }}">
                            {{ ucfirst(str_replace('_', ' ', $siniestro->estado)) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Empleado:</strong> {{ $siniestro->empleado->nombres }} {{ $siniestro->empleado->paterno }}
                    </p>
                    <p><strong>Registrado el:</strong> {{ $siniestro->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            <hr>
            <h5>Descripción del Siniestro</h5>
            <p class="bg-light p-3 rounded">{{ $siniestro->descripcion }}</p>
        </div>
    </div>
@stop
