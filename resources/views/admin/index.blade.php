@extends('adminlte::page')

@section('title', 'Dashboard - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Panel de Administración</h1>
        <span style="font-size: 1.8rem; font-weight: 600; color: #000000;">
            Rol: {{ session('empleado_rol') }}
        </span>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">¡Bienvenido a SOAT Pankej!</h2>
            <p class="card-text">
                Bienvenido al panel de administración de <strong>SOAT Pankej</strong>.
                Aquí podrás gestionar todos los aspectos de nuestra plataforma de seguros.
                Como {{ session('empleado_rol') }}, tienes acceso a herramientas avanzadas para administrar empleados,
                clientes y más.
            </p>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-logout {
            height: 45px;
            font-size: 1.1rem;
            font-weight: 700;
            background: linear-gradient(45deg, #005f73, #00b7eb);
            color: #fff;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 10px rgba(0, 183, 235, 0.3);
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: linear-gradient(45deg, #003f5c, #0098c7);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 183, 235, 0.5);
        }

        .btn-logout:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 183, 235, 0.2);
        }

        .card-title {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            color: #005f73;
        }

        .card-text {
            font-size: 1.1rem;
            color: #333;
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package for SOAT Pankej!");
    </script>
@stop
