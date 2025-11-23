{{-- resources/views/Tipos-Seguro/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Tipo de Seguro - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-shield-alt text-warning"></i> Editar Tipo de Seguro
        </h1>
        <a href="{{ route('tipos-seguro.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al listado
        </a>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-edit"></i> Modificar Tipo de Seguro
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

                    <form action="{{ route('tipos-seguro.update', $tipo->id_tipo) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="nombre" class="font-weight-bold">
                                <i class="fas fa-tag"></i> Nombre del Tipo de Seguro *
                            </label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $tipo->nombre) }}"
                                placeholder="Ej: SOAT, Automotriz, Todo Riesgo..." required autofocus>
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="descripcion" class="font-weight-bold">
                                <i class="fas fa-align-left"></i> Descripción (opcional)
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="5"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Describe brevemente este tipo de seguro...">{{ old('descripcion', $tipo->descripcion) }}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-warning btn-lg px-5">
                                <i class="fas fa-save"></i> Actualizar Tipo
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center small text-muted">
                    <i class="fas fa-info-circle"></i>
                    ID del tipo: <strong>#{{ $tipo->id_tipo }}</strong> |
                    Creado: {{ $tipo->created_at->format('d/m/Y') }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 1rem;
            overflow: hidden;
        }

        .bg-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800) !important;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            border: none;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e0a800, #d39e00);
            transform: translateY(-2px);
        }

        .form-control-lg {
            border-radius: 0.75rem;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            });
        @endif
    </script>
@stop
