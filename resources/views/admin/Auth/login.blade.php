<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro - SOAT Pankej</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            background: url('https://i.pinimg.com/originals/c3/2a/cb/c32acb8b243d78c196a5ed7c89d52ea5.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 0;
        }

        .login-card {
            position: relative;
            z-index: 1;
            background: linear-gradient(135deg, #d3d3d3, #e0e0e0);
            /* Gradiente plateado */
            backdrop-filter: blur(5px);
            border-radius: 1rem;
            padding: 1.5rem;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            text-align: center;
            border: 1px solid #b0b0b0;
            /* Borde plateado */
        }

        .login-card h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            color: #333;
            /* Texto oscuro en fondo plateado */
            font-size: 2.5rem;
            letter-spacing: 2px;
        }

        .form-label {
            font-weight: 700;
            color: #333;
            /* Texto oscuro para etiquetas */
            font-size: 1.2rem;
        }

        .form-control {
            height: 40px;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            /* Texto oscuro en campos */
            background-color: #f0f0f0;
            /* Fondo gris claro */
            border: 2px solid #666;
            /* Borde gris oscuro */
            border-radius: 0.5rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #b0b0b0;
            /* Plateado claro al enfocar */
            box-shadow: 0 0 8px rgba(176, 176, 176, 0.6);
        }

        ::placeholder {
            color: #999;
            /* Gris medio para placeholders */
            font-weight: 500;
        }

        .btn-login {
            height: 45px;
            font-size: 1.1rem;
            font-weight: 700;
            background: #1a1a1a;
            /* Negro sólido */
            color: #fff;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #000;
            /* Negro más profundo al hover */
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #333;
            /* Texto oscuro para checkboxes */
            font-weight: 600;
        }

        .nav-tabs .nav-link {
            color: #999898;
            /* Texto oscuro para pestañas */
            font-weight: 600;
            font-size: 1.1rem;
            background-color: #2c2a2a;
            /* Fondo plateado claro */
            border: 1px solid #b0b0b0;
            /* Borde plateado */
        }

        .nav-tabs .nav-link.active {
            background-color: #202020;
            /* Plateado medio para pestaña activa */
            color: #fff;
            border-color: #b0b0b0;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .text-danger {
            font-size: 0.9rem;
            color: #ff3333;
            /* Rojo claro para errores */
        }

        .alert {
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            /* Verde claro para éxito */
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            /* Rojo claro para errores */
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .btn-close {
            filter: invert(0);
            /* Icono de cerrar en color original */
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 1rem;
            }

            .login-card h1 {
                font-size: 2rem;
            }

            .form-control,
            .btn-login {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h1>SOAT Pankej</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Pestañas para Login y Registro -->
        <ul class="nav nav-tabs mb-3" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                    type="button" role="tab" aria-controls="login" aria-selected="true">Iniciar Sesión</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                    type="button" role="tab" aria-controls="register" aria-selected="false">Registrarse</button>
            </li>
        </ul>

        <div class="tab-content" id="authTabContent">
            <!-- Formulario de Login -->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <form method="POST" action="{{ route('admin.authenticate') }}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="login" class="form-label">Usuario</label>
                        <input type="text" name="login" id="login" class="form-control"
                            placeholder="Ingrese su usuario" value="{{ old('login') }}" required autofocus>
                        @error('login')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="clave" class="form-label">Contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control"
                            placeholder="Ingrese su contraseña" required>
                        @error('clave')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check text-start">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>

                    <button type="submit" class="btn btn-login w-100">Iniciar Sesión</button>
                </form>
            </div>

            <!-- Formulario de Registro -->
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                <form method="POST" action="{{ route('empleados.store') }}">
                    @csrf
                    <div class="row">
                        <!-- Columna izquierda -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="register-login" class="form-label">Usuario</label>
                                <input type="text" name="login" id="register-login" class="form-control"
                                    placeholder="Ingrese su usuario" value="{{ old('login') }}" required>
                                @error('login')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="register-clave" class="form-label">Contraseña</label>
                                <input type="password" name="clave" id="register-clave" class="form-control"
                                    placeholder="Ingrese su contraseña" required>
                                @error('clave')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" name="correo" id="correo" class="form-control"
                                    placeholder="Ingrese su correo" value="{{ old('correo') }}" required>
                                @error('correo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="rol" class="form-label">Rol</label>
                                <select name="rol" id="rol" class="form-control" required>
                                    <option value="" disabled selected>Seleccione un rol</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Agente de Ventas">Agente de Ventas</option>
                                    <option value="Gestor Siniestro">Gestor Siniestro</option>
                                </select>
                                @error('rol')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" name="nombres" id="nombres" class="form-control"
                                    placeholder="Ingrese sus nombres" value="{{ old('nombres') }}">
                                @error('nombres')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paterno" class="form-label">Apellido Paterno</label>
                                <input type="text" name="paterno" id="paterno" class="form-control"
                                    placeholder="Ingrese su apellido paterno" value="{{ old('paterno') }}">
                                @error('paterno')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="materno" class="form-label">Apellido Materno</label>
                                <input type="text" name="materno" id="materno" class="form-control"
                                    placeholder="Ingrese su apellido materno" value="{{ old('materno') }}">
                                @error('materno')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nro_telefono" class="form-label">Teléfono</label>
                                <input type="text" name="nro_telefono" id="nro_telefono" class="form-control"
                                    placeholder="Ingrese su número de teléfono" value="{{ old('nro_telefono') }}">
                                @error('nro_telefono')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="contratacion" class="form-label">Fecha de Contratación</label>
                                <input type="date" name="contratacion" id="contratacion" class="form-control"
                                    value="{{ old('contratacion') }}">
                                @error('contratacion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group form-check text-start">
                                <input type="checkbox" class="form-check-input" id="estado" name="estado"
                                    value="1">
                                <label class="form-check-label" for="estado">Activo</label>
                                @error('estado')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login w-100 mt-3">Registrarse</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
