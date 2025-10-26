<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('cliente.home');
})->name('home');

// Rutas para administración (asociadas a empleados)
Route::get('/admin', [EmpleadoController::class, 'login'])->name('admin.login');
Route::post('/login-admin', [EmpleadoController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [EmpleadoController::class, 'logout'])->name('admin.logout');
Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');

Route::get('/admin/index', [EmpleadoController::class, 'index'])->name('admin.index');
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::get('/empleados/{id_empleado}', [EmpleadoController::class, 'show'])->name('empleados.show');
Route::get('/empleados/{id_empleado}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::put('/empleados/{id_empleado}', [EmpleadoController::class, 'update'])->name('empleados.update');
Route::delete('/empleados/{id_empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');

// Rutas para autenticación de clientes
Route::get('/register-cliente', [ClienteController::class, 'create'])->name('register.cliente');
Route::post('/register-cliente', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/login-cliente', [ClienteController::class, 'login'])->name('login');
Route::post('/login-cliente', [ClienteController::class, 'authenticate'])->name('clientes.authenticate');
Route::get('/logout-cliente', [ClienteController::class, 'logout'])->name('clientes.logout');
// Rutas CRUD para Cliente (accesible por clientes autenticados)

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{id_cliente}', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/clientes/{id_cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id_cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id_cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

// Rutas CRUD para Categoria (accesible por empleados)
Route::middleware(['auth'])->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{id_categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/{id_categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{id_categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{id_categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});

// Otras rutas de cliente
Route::get('/guia-siniestro', function () {
    return view('cliente.guia-siniestro');
})->name('guia.siniestro');

Route::get('/contactar', function () {
    return view('cliente.contactar');
})->name('contactar');

Route::get('/VerificarVigencia', function () {
    return view('cliente.VerificarVigencia');
})->name('verificar.vigencia');

Route::get('/loginComprobante', function () {
    return view('cliente.loginComprobante');
})->name('login.comprobante');

Route::get('/ComprobanteDigital', function () {
    return view('cliente.Auth.ComprobanteDigital');
})->name('comprobante.digital');

// Rutas para el cotizador
Route::get('/cotizar', function () {
    return view('cliente.cotizar');
})->name('cliente.cotizar');

Route::post('/cotizar/paso2', function (Request $request) {
    return view('cliente.cotizar-paso2', [
        'datosCliente' => $request->only(['nombres', 'apellidos', 'ci', 'email', 'celular', 'direccion'])
    ]);
})->name('cotizar.paso2');

Route::post('/cotizar/paso3', function (Request $request) {
    return view('cliente.cotizar-paso3', [
        'datosCliente' => $request->only(['nombres', 'apellidos', 'ci', 'email', 'celular', 'direccion']),
        'tipo_vehiculo' => $request->tipo_vehiculo,
        'marca' => $request->marca,
        'anio' => $request->anio,
        'procedencia' => $request->procedencia,
        'paquete_km' => $request->paquete_km
    ]);
})->name('cotizar.paso3');

Route::post('/cotizar/paso4', function (Request $request) {
    return view('cliente.cotizar-paso4');
})->name('cotizar.pdf');

/* AUN NO DEFINIDO .
Route::post('/cotizar/generar-pdf', function (Request $request) {
    $data = $request->all();
    $pdf = Pdf::loadView('cliente.cotizar-pdf', $data);
    return $pdf->download('cotizacion.pdf');
})->name('cotizar.generar.pdf');
*/
