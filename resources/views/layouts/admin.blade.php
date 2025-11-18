{{-- resources/views/layouts/admin.blade.php --}}
@extends('adminlte::page')

{{-- Título dinámico --}}
@section('title', $title ?? 'SOAT Pankej - Panel')

{{-- Contenido del header (arriba) --}}
@section('content_header')
    <h1 class="m-0">{{ $title ?? 'Panel de Administración' }}</h1>
@stop

{{-- Contenido principal --}}
@section('content')
    @yield('main-content')
@stop

{{-- MENÚ LATERAL PERSONALIZADO POR ROL --}}
@section('adminlte_sidebar')
    @include('partials.adminlte.user-menu')
@stop

{{-- MENÚ ARRIBA A LA DERECHA (el del rol) --}}
@section('adminlte_js')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarNav = document.querySelector('.navbar-nav.ms-auto') || document.querySelector(
                '.navbar-nav.ml-auto');
            if (!navbarNav) return;

            const rol = "{{ ucfirst(strtolower(session('empleado_rol') ?? 'Empleado')) }}";

            const menuHTML = `
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fas fa-user-tag"></i>
                        <span class="d-none d-md-inline ml-2 font-weight-bold" style="font-size:1.1rem;">${rol}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center bg-primary text-white py-3">
                            <i class="fas fa-shield-alt mr-2"></i> ${rol}
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="p-3 text-center">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            `;
            navbarNav.insertAdjacentHTML('beforeend', menuHTML);
        });
    </script>
@stop
