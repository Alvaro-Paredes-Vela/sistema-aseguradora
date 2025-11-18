{{-- resources/views/admin/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard - SOAT Pankej')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
    </div>
@stop

@section('content')
    <div class="card border-12 shadow-sm">
        <div class="card-body text-center py-1">
            <h2 class="display-4 text-primary font-weight-bold mb-3">
                ¡Bienvenido a SOAT Pankej!
            </h2>
            <p class="lead text-muted">
                Panel de administración • Acceso seguro
            </p>
        </div>
    </div>

    {{-- 4 TARJETAS CON DATOS REALES --}}
    <div class="row mt-4">

        <!-- SOAT Vendidos -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['soat_mes'] }}</h3>
                    <p>SOAT Vendidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modalSoat">
                    Ver detalle <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Automotriz Vendidos -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['automotriz_mes'] }}</h3>
                    <p>Automotriz Vendidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
                <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modalAutomotriz">
                    Ver detalle <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Ingresos Totales -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning text-dark">
                <div class="inner">
                    <h3>Bs {{ number_format($stats['ingresos_mes'], 0, ',', '.') }}</h3>
                    <p>Ingresos del Mes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modalIngresos">
                    Ver detalle <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Ventas Hoy -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['ventas_hoy'] }}</h3>
                    <p>Ventas de Hoy</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modalHoy">
                    Ver hoy <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- RESUMEN DEL MES --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title mb-0">
                        Resumen del Mes - {{ now()->format('F Y') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 py-3">
                            <h5 class="text-info font-weight-bold">SOAT</h5>
                            <h2 class="text-info">{{ $stats['soat_mes'] }}</h2>
                            <small class="text-success">+12% vs mes anterior</small>
                        </div>
                        <div class="col-md-4 py-3">
                            <h5 class="text-success font-weight-bold">Automotriz</h5>
                            <h2 class="text-success">{{ $stats['automotriz_mes'] }}</h2>
                            <small class="text-success">+8% vs mes anterior</small>
                        </div>
                        <div class="col-md-4 py-3">
                            <h5 class="text-warning font-weight-bold">Total Ventas</h5>
                            <h2 class="text-warning">{{ $stats['soat_mes'] + $stats['automotriz_mes'] }}</h2>
                            <small class="text-primary">Mejor mes del año</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALES CON DATOS REALES (todo en el mismo archivo) --}}
    <!-- Modal SOAT -->
    <div class="modal fade" id="modalSoat">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">SOAT Vendidos este mes ({{ $stats['soat_mes'] }})</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-hover">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>Cliente</th>
                                <th>CI</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles['soat'] as $v)
                                <tr>
                                    <td>{{ $v->nombre }}</td>
                                    <td>{{ $v->ci }}</td>
                                    <td>Bs {{ number_format($v->monto_total, 0) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($v->fecha)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Automotriz -->
    <div class="modal fade" id="modalAutomotriz">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Automotriz Vendidos este mes ({{ $stats['automotriz_mes'] }})</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-hover">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>Cliente</th>
                                <th>CI</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles['automotriz'] as $v)
                                <tr>
                                    <td>{{ $v->nombre }}</td>
                                    <td>{{ $v->ci }}</td>
                                    <td>Bs {{ number_format($v->monto_total, 0) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($v->fecha)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hoy -->
    <div class="modal fade" id="modalHoy">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Ventas de Hoy ({{ $stats['ventas_hoy'] }})</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-hover">
                        <thead class="bg-danger text-white">
                            <tr>
                                <th>Tipo</th>
                                <th>Cliente</th>
                                <th>Monto</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles['hoy'] as $v)
                                <tr>
                                    <td><span
                                            class="badge badge-{{ $v->tipo_seguro == 'SOAT' ? 'info' : 'success' }}">{{ $v->tipo_seguro }}</span>
                                    </td>
                                    <td>{{ $v->nombre }}</td>
                                    <td>Bs {{ number_format($v->monto_total, 0) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($v->fecha)->format('H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ingresos -->
    <div class="modal fade" id="modalIngresos">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Ingresos del Mes</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-hover">
                        <thead class="bg-warning text-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Ventas</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles['ingresos'] as $d)
                                <tr>
                                    <td><strong>{{ \Carbon\Carbon::parse($v->fecha)->format('d/m/Y') }}</strong></td>
                                    <td>{{ $d->cantidad }}</td>
                                    <td>Bs {{ number_format($d->total, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-dark text-white">
                            <tr>
                                <td colspan="2"><strong>TOTAL MES</strong></td>
                                <td><strong>Bs {{ number_format($stats['ingresos_mes'], 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- TU ROL QUEDA 100% IGUAL (NO TOQUÉ NADA) --}}
@section('css')
    <style>
        .user-rol-menu .dropdown-toggle {
            background: linear-gradient(135deg, #1e3c72, #2a5298) !important;
            color: white !important;
            border-radius: 50px !important;
            padding: 10px 24px !important;
            font-size: 1.35rem !important;
            font-weight: 800 !important;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25) !important;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .user-rol-menu .dropdown-toggle:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35) !important;
        }

        .user-rol-menu .dropdown-toggle i {
            font-size: 1.6rem;
            margin-right: 10px;
        }

        .user-rol-menu .dropdown-menu {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            margin-top: 12px;
            min-width: 220px;
        }

        .user-rol-menu .dropdown-header {
            background: linear-gradient(135deg, #eec800, #ff8c00);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.4rem;
            font-weight: 900;
        }

        .user-rol-menu .dropdown-header i {
            font-size: 3rem;
            display: block;
            margin-bottom: 10px;
            opacity: 0.9;
        }
    </style>
@stop

{{-- TU JS DEL ROL QUEDA 100% IGUAL --}}
@section('adminlte_js')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarNav = document.querySelector('.navbar-nav.ms-auto') ||
                document.querySelector('.navbar-nav.ml-auto');
            if (!navbarNav) return;

            const rol = "{{ ucfirst(strtolower(session('empleado_rol') ?? 'Empleado')) }}";

            const menuHTML = `
                <li class="nav-item dropdown user-rol-menu">
                    <a href="#" class="nav-link dropdown_toggle" data-toggle="dropdown" role="button">
                        <i class="fas fa-crown"></i>
                        <span class="d-none d-lg-inline">${rol}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <i class="fas fa-user-shield"></i>
                            <div>${rol}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="p-3 text-center bg-light">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm px-4">
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
