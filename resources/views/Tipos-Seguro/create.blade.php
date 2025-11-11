{{-- resources/views/admin/tipos-seguro/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Nuevo Tipo de Seguro - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Nuevo Tipo de Seguro</h1>
        <a href="{{ route('tipos-seguro.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-plus-circle"></i> Crear Tipo de Seguro
                    </h3>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tipos-seguro.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold text-primary">
                                <i class="fas fa-tag"></i> Nombre del Tipo *
                            </label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}"
                                placeholder="Ej: SOAT, Todo Riesgo, Terceros" required autofocus>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Máximo 100 caracteres. Debe ser único.</small>
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="form-label fw-bold text-info">
                                <i class="fas fa-align-left"></i> Descripción (Opcional)
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="4"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Describe para qué sirve este tipo de seguro...">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                <i class="fas fa-save"></i> Guardar Tipo
                            </button>
                            <a href="{{ route('tipos-seguro.index') }}" class="btn btn-outline-danger btn-lg">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>

                <div class="card-footer bg-light small text-center">
                    <i class="fas fa-lightbulb text-warning"></i>
                    <strong>Consejo:</strong> Usa nombres claros como <code>SOAT</code>, <code>Todo Riesgo</code>.
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        .card {
            border-radius: 1.2rem;
            overflow: hidden;
        }

        .card-header {
            border-radius: 1.2rem 1.2rem 0 0 !important;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .btn-success {
            background: linear-gradient(45deg, #28a745, #34ce57);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #218838, #28a745);
            transform: translateY(-2px);
        }
    </style>
@stop
