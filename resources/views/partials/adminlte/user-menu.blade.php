<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
        <i class="fas fa-user-shield text-warning"></i>
        <span class="d-none d-md-inline font-weight-bold">
            {{ ucfirst(strtolower(session('empleado_rol', 'Empleado'))) }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center bg-dark text-white py-3">
            <i class="fas fa-shield-alt fa-2x text-warning mb-2"></i><br>
            <strong>{{ ucfirst(strtolower(session('empleado_rol', 'Empleado'))) }}</strong>
        </div>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('admin.logout') }}" class="dropdown-item text-center">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</li>
