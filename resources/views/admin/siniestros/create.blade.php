@extends('adminlte::page')

@section('title', 'Registrar Nuevo Siniestro')

@section('content_header')
    <h1 class="m-0">
        <i class="fas fa-plus-circle text-success"></i> Registrar Siniestro
    </h1>
@stop

@section('content')
    <div class="card card-success shadow-sm border-0">
        <div class="card-header bg-gradient-success text-white">
            <h3 class="card-title">
                <i class="fas fa-search"></i> Buscar Póliza Vigente
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('siniestros.buscar') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-9">
                    <label class="font-weight-bold">Placa o Número de Póliza</label>
                    <input type="text" name="busqueda" class="form-control form-control-lg text-uppercase"
                        placeholder="Ej: 1234ABC o POL-AUTO-000001" required autofocus>
                </div>
                <div class="col-md-3 align-self-end">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        <i class="fas fa-search"></i> Buscar Póliza
                    </button>
                </div>
            </form>

            @if (session('error'))
                <div class="alert alert-danger mt-4">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
@stop

@section('css')
    <style>
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745, #218838);
        }
    </style>
@stop
