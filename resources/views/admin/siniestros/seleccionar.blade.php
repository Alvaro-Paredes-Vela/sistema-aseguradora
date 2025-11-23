{{-- Cuando hay SOAT + Automotriz, el empleado elige para cuál reportar --}}
@extends('adminlte::page')

@section('title', 'Seleccionar Póliza para Siniestro')

@section('content_header')
    <h1 class="m-0">
        <i class="fas fa-car-crash text-danger"></i> Seleccionar Póliza
    </h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header bg-gradient-warning text-dark">
            <h3 class="card-title">
                <i class="fas fa-exclamation-triangle"></i>
                Este vehículo tiene más de una póliza vigente
            </h3>
        </div>
        <div class="card-body">
            <p class="mb-4">
                La placa <strong class="text-primary">{{ $polizas->first()->vehiculo->placa }}</strong>
                tiene <strong>{{ $polizas->count() }} pólizas vigentes</strong>.
                Por favor selecciona para cuál póliza deseas reportar el siniestro:
            </p>

            <div class="row">
                @foreach ($polizas as $poliza)
                    <div class="col-md-6 mb-4">
                        <div
                            class="card border {{ $poliza->seguro->nombre == 'SOAT' ? 'border-info' : 'border-success' }} shadow-sm">
                            <div
                                class="card-header {{ $poliza->seguro->nombre == 'SOAT' ? 'bg-info' : 'bg-success' }} text-white">
                                <h5 class="mb-0">
                                    @if ($poliza->seguro->nombre == 'SOAT')
                                        <i class="fas fa-shield-alt"></i> SOAT
                                    @else
                                        <i class="fas fa-car"></i> Seguro Automotriz
                                    @endif
                                    – {{ $poliza->numero_poliza }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Cliente:</strong> {{ $poliza->vehiculo->cliente->nombre_completo ?? '—' }}</p>
                                <p><strong>Válida hasta:</strong>
                                    {{ \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y') }}</p>
                                <p><strong>Cobertura:</strong>
                                    @if ($poliza->seguro->nombre == 'SOAT')
                                        Accidentes personales y daños a terceros (obligatorio)
                                    @else
                                        Daños propios + responsabilidad civil
                                    @endif
                                </p>

                                {{-- Por este formulario oculto (hace POST): --}}
                                <form action="{{ route('siniestros.buscar') }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="poliza_directa" value="{{ $poliza->id_poliza }}">
                                    <button type="submit"
                                        class="btn btn-lg btn-block {{ $poliza->seguro->nombre == 'SOAT' ? 'btn-outline-info' : 'btn-outline-success' }}">
                                        <i class="fas fa-arrow-right"></i> Reportar siniestro para esta póliza
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('siniestros.crear') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a buscar
                </a>
            </div>
        </div>
    </div>
@stop
