<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\SoatController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\TipoSeguroController;
use App\Http\Controllers\PolizaController;
use App\Http\Controllers\PagoPendienteController;

// === PÁGINA PRINCIPAL (pública) ===
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas para la página principal del cliente
Route::get('/home', [ClienteController::class, 'index'])->name('home');

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

/// routes/web.php
Route::prefix('admin')->name('admin.')->group(function () {

    // PENDIENTES (YA LA TIENES)
    Route::get('/pagos-pendientes', [PagoPendienteController::class, 'index'])
        ->name('pagos-pendientes.index');

    // APROBAR / RECHAZAR (CORREGIDO: usa {pago}, no {venta})
    Route::post('/pagos-pendientes/{pago}/aprobar', [PagoPendienteController::class, 'aprobar'])
        ->name('pagos-pendientes.aprobar');

    Route::post('/pagos-pendientes/{pago}/rechazar', [PagoPendienteController::class, 'rechazar'])
        ->name('pagos-pendientes.rechazar');

    // NUEVAS RUTAS PARA APROBADOS Y RECHAZADOS
    Route::get('/pagos/aprobados', [PagoPendienteController::class, 'aprobados'])
        ->name('pagos.aprobados');

    Route::get('/pagos/rechazados', [PagoPendienteController::class, 'rechazados'])
        ->name('pagos.rechazados');
});

// === CLIENTES (público + auth manual) ===
Route::prefix('cliente')->name('cliente.')->group(function () {
    // Auth pública
    Route::get('/login', [ClienteController::class, 'loginForm'])->name('login');
    Route::post('/login', [ClienteController::class, 'login'])->name('authenticate');
    Route::get('/logout', [ClienteController::class, 'logout'])->name('logout');
    Route::get('/register', [ClienteController::class, 'registerForm'])->name('register');
    Route::post('/register', [ClienteController::class, 'store'])->name('store');
    // Dashboard (auth manual en controlador)
    Route::get('/dashboard', [ClienteController::class, 'dashboard'])->name('dashboard');

    // Dashboard SOAT (home)
    Route::get('/soat', [ClienteController::class, 'soatDashboard'])->name('soat');  // Nueva ruta

    // Automotriz
    Route::get('/automotriz', [ClienteController::class, 'automotriz'])->name('automotriz');

    // Perfil (auth manual en controlador)
    Route::get('/perfil', [ClienteController::class, 'edit'])->name('perfil');
    Route::put('/perfil', [ClienteController::class, 'update'])->name('update');
    Route::delete('/cuenta', [ClienteController::class, 'destroy'])->name('destroy');

    // Futuras: cotizar, vigencia, etc.
    Route::get('/cotizar', [ClienteController::class, 'cotizarForm'])->name('cotizar');  // Placeholder
    Route::get('/vigencia', [ClienteController::class, 'vigencia'])->name('vigencia');
    Route::get('/comprobante', [ClienteController::class, 'comprobante'])->name('comprobante');

    // routes/web.php
    Route::get('/precios-soat', function () {
        return view('cliente.Comprar-Soat.precios');
    })->name('soat.precios');
});
/*
// Rutas para autenticación de clientes
Route::get('/register-cliente', [ClienteController::class, 'create'])->name('register.cliente');
Route::post('/register-cliente', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/login-cliente', [ClienteController::class, 'login'])->name('login');
Route::post('/login-cliente', [ClienteController::class, 'authenticate'])->name('clientes.authenticate');
Route::get('/logout-cliente', [ClienteController::class, 'logout'])->name('clientes.logout');
// Rutas CRUD para Cliente (accesible por clientes autenticados)

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{id_cliente}', [ClienteController::class, 'show'])->name('clientes.show');
Route::put('/clientes/{id_cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::get('/clientes/{id_cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::delete('/clientes/{id_cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
*/
// Rutas CRUD para Categoria (accesible por empleados)
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id_categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/categorias/{id_categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id_categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id_categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

// rutas para tipo de seguro
Route::get('/tipos-seguro', [TipoSeguroController::class, 'index'])->name('tipos-seguro.index');
Route::get('/tipos-seguro/create', [TipoSeguroController::class, 'create'])->name('tipos-seguro.create');
Route::post('/tipos-seguro', [TipoSeguroController::class, 'store'])->name('tipos-seguro.store');
Route::get('/tipos-seguro/{id_tipo}/edit', [TipoSeguroController::class, 'edit'])->name('tipos-seguro.edit');
Route::put('/tipos-seguro/{id_tipo}', [TipoSeguroController::class, 'update'])->name('tipos-seguro.update');
Route::delete('/tipos-seguro/{id_tipo}', [TipoSeguroController::class, 'destroy'])->name('tipos-seguro.destroy');

// Otras rutas de cliente
Route::get('/guia-siniestro', function () {
    return view('cliente.guia-siniestro');
})->name('guia.siniestro');

Route::get('/reportar-siniestro', function () {
    return view('cliente.reportar-siniestro');
})->name('reportar.siniestro');

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
Route::get('/Precio', function (Request $request) {
    return view('admin.precio');
})->name('precio');

Route::get('/Solicitar', function (Request $request) {
    return view('cliente.solicitarAgente');
})->name('Solicitar.agente');

/* ruta para la compra de soat
Route::get('/ventas-soat', function (Request $request) {
    return view('cliente.Comprar-Soat.buscar-vehiculo');
})->name('buscar.vehiculo');
*/

// Ruta para el archivo automotriz.blade.php
Route::get('/automotriz', [ClienteController::class, 'automotriz'])->name('automotriz');

// Rutas para gestión de reclamos
Route::post('/contactanos', [ReclamoController::class, 'store'])->name('reclamos.store');

/*============================================================================================================*/
Route::prefix('soat')->name('soat.')->group(function () {

    // 0. ruta dashboard soat
    //Route::get('/', [SoatController::class, 'index'])->name('index');

    // routes/web.php
    Route::get('/comprobar-soat', [SoatController::class, 'comprobarForm'])->name('comprobar.form');
    Route::post('/comprobar-soat', [SoatController::class, 'comprobar'])->name('comprobar');
    Route::get('/verificar-vigencia', [SoatController::class, 'verificarForm'])->name('verificar.form');
    Route::post('/verificar-vigencia', [SoatController::class, 'verificar'])->name('verificar');

    Route::get('/soat/poliza/{id}/descargar', [SoatController::class, 'descargarPoliza'])->name('poliza.descargar');
    Route::get('/soat/poliza/{id}/descargar_Poliza', [SoatController::class, 'descargarPolizaVigente'])
        ->name('poliza');

    // routes/web.php
    Route::get('/factura/{nro}/pdf', [SoatController::class, 'descargarFactura'])
        ->name('factura.pdf');

    Route::get('/soat/puntos-venta', function () {
        return view('cliente.Comprar-Soat.puntos-venta');
    })->name('puntos-venta');

    // 1. Búsqueda
    Route::get('/buscar', [SoatController::class, 'buscarForm'])->name('buscar.form');
    Route::post('/buscar', [SoatController::class, 'buscar'])->name('buscar');

    // 2. Vehículo
    Route::get('/vehiculo/create', [VehiculoController::class, 'create'])->name('vehiculo.create');
    Route::post('/vehiculo', [VehiculoController::class, 'store'])->name('vehiculo.store');

    // 3. Pago
    Route::get('/pago/{placa}', [SoatController::class, 'pagoForm'])->name('pago.form');
    Route::post('/pago', [SoatController::class, 'pagoStore'])->name('pago.store');
    // limpiar placa de sesión después del pago
    // routes/web.php
    Route::post('/soat/limpiar-resultado', [SoatController::class, 'limpiarResultado'])->name('limpiar.resultado');
    Route::post('/soat/limpiar-placa', [SoatController::class, 'limpiarPlaca'])->name('limpiar.placa');

    // 4. QR
    Route::get('/pago-qr/{placa}', [SoatController::class, 'qr'])->name('qr');  // FIJADO!

    // 5. Compra + Comprobante
    Route::post('/comprar', [SoatController::class, 'confirmarPago'])->name('comprar');  // POST /soat/comprar
    Route::get('/soat/espera/{venta_id}', [SoatController::class, 'espera'])->name('espera');
    // routes/web.php
    Route::get('/soat/comprobante/{venta_id}', [SoatController::class, 'comprobante'])->name('comprobante');  // GET /soat/comprobante
    Route::get('/descargar-pdf/{id}', [SoatController::class, 'descargarPdf'])->name('descargar.pdf');  // /soat/descargar-pdf/{id}

});


// BUSCAR Y ACTUALIZAR PÓLIZA
// 1. MOSTRAR FORMULARIO DE BÚSQUEDA (GET)
Route::get('/soat/poliza/actualizar', [PolizaController::class, 'buscarPolizaForm'])
    ->name('soat.poliza.actualizar.form');

// 2. BUSCAR PÓLIZA POR PLACA (POST)
Route::get('/soat/poliza/buscar', [PolizaController::class, 'buscarPoliza'])
    ->name('soat.poliza.buscar');

// 3. ACTUALIZAR PÓLIZA (PUT)
Route::put('/soat/poliza/{id}', [PolizaController::class, 'actualizarPoliza'])
    ->name('soat.poliza.actualizar');
