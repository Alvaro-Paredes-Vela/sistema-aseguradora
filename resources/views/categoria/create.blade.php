@extends('adminlte::page')

@section('title', 'Nueva Categoría - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Nueva Categoría</h1>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-plus-circle"></i> Crear Categoría
                    </h3>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('categorias.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">
                                <i class="fas fa-tag text-primary"></i> Nombre de la Categoría *
                            </label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}"
                                placeholder="Ej: SOAT, Todo Riesgo, Terceros" required autofocus>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">
                                <i class="fas fa-align-left text-info"></i> Descripción (Opcional)
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="4"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Describe para qué sirve esta categoría...">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="activo" id="activo" class="form-check-input" value="1"
                                    checked>
                                <label for="activo" class="form-check-label fw-bold text-success">
                                    <i class="fas fa-toggle-on"></i> Categoría Activa
                                </label>
                            </div>
                            <small class="text-muted">Desactiva si no quieres que aparezca en formularios.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-save"></i> Guardar Categoría
                            </button>
                            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-muted small">
                    <i class="fas fa-info-circle"></i>
                    Los campos con * son obligatorios.
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-header">
                    <h5><i class="fas fa-lightbulb"></i> Consejos</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Usa nombres claros y únicos.</li>
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Ejemplos: SOAT, Todo Riesgo, RC.</li>
                        <li class="mb-2"><i class="fas fa-check text-success"></i> La descripción ayuda a otros empleados.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        .card {
            border-radius: 1rem;
        }

        .card-header {
            border-radius: 1rem 1rem 0 0 !important;
        }

        .form-control:focus,
        .form-check-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-success {
            background: linear-gradient(45deg, #28a745, #34ce57);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #218838, #28a745);
            transform: translateY(-1px);
        }
    </style>
@stop

@section('js')
    <script>
        // Feedback visual al escribir
        document.getElementById('nombre').addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    </script>
@stop
