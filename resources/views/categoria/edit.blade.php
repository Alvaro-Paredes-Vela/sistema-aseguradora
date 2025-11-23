{{-- resources/views/categoria/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Categoría - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-tags text-info"></i> Editar Categoría
        </h1>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al listado
        </a>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-edit"></i> Modificar Categoría
                    </h3>
                </div>

                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">×</button>
                        </div>
                    @endif

                    <form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="nombre" class="font-weight-bold">
                                <i class="fas fa-tag text-info"></i> Nombre de la Categoría *
                            </label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $categoria->nombre) }}"
                                placeholder="Ej: Motocicletas, Automóviles, Camiones..." required autofocus>
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="coberturas" class="font-weight-bold">
                                <i class="fas fa-shield-alt text-success"></i> Coberturas (opcional)
                            </label>
                            <textarea name="coberturas" id="coberturas" rows="4"
                                class="form-control @error('coberturas') is-invalid @enderror"
                                placeholder="Ej: Daños a terceros, robo, accidente personal...">{{ old('coberturas', $categoria->coberturas) }}</textarea>
                            @error('coberturas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="descripcion" class="font-weight-bold">
                                <i class="fas fa-align-left"></i> Descripción (opcional)
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="5"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Descripción detallada de esta categoría...">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-info btn-lg px-5">
                                <i class="fas fa-save"></i> Actualizar Categoría
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center small text-muted bg-light">
                    <i class="fas fa-info-circle"></i>
                    ID: <strong>#{{ $categoria->id_categoria }}</strong> |
                    Creada el {{ $categoria->created_at->format('d/m/Y H:i') }}
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

        .bg-info {
            background: linear-gradient(135deg, #17a2b8, #117a8b) !important;
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8, #117a8b);
            border: none;
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.4);
            transition: all 0.3s;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #117a8b, #0c5d6e);
            transform: translateY(-3px);
        }

        .form-control-lg,
        textarea.form-control {
            border-radius: 0.75rem;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Perfecto!',
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
