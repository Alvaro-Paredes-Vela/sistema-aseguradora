@extends('adminlte::page')

@section('title', 'Categorías')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Categorías</h3>
            <a href="{{ route('categorias.create') }}" class="btn btn-success btn-sm">+ Nueva</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $c)
                        <tr>
                            <td>{{ $c->id_categoria }}</td>
                            <td>{{ $c->nombre }}</td>
                            <td>{{ $c->activo ? 'Activa' : 'Inactiva' }}</td>
                            <td>
                                <a href="{{ route('categorias.edit', $c->id_categoria) }}"
                                    class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('categorias.destroy', $c->id_categoria) }}" method="POST"
                                    style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
