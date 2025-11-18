{{-- resources/views/categorias/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Categorías - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Categorías</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Categoría
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-tags"></i> Lista de Categorías
            </h3>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th width="80">ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th width="150" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $c)
                            <tr>
                                <td><strong>{{ $c->id_categoria }}</strong></td>
                                <td>{{ $c->nombre ?? '<em class="text-muted">Sin nombre</em>' }}</td>

                                <td>
                                    @if ($c->descripcion)
                                        <small class="text-muted">{{ Str::limit($c->descripcion, 80) }}</small>
                                    @else
                                        <em class="text-muted">Sin descripción</em>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('categorias.edit', $c->id_categoria) }}"
                                        class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('categorias.destroy', $c->id_categoria) }}" method="POST"
                                        style="display:inline" class="delete-form">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-3"></i><br>
                                    No hay categorías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-center small text-muted">
            <i class="fas fa-info-circle"></i>
            Solo se pueden eliminar categorías que no estén asociadas a seguros.
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .btn-sm i {
            font-size: 0.9rem;
        }

        .alert {
            border-radius: 0.75rem;
        }

        .badge {
            font-size: 0.9rem;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Confirmación bonita con SweetAlert2
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta categoría se eliminará permanentemente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop
