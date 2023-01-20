<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PuertaController;
use App\Http\Controllers\admin\SectorController;
use App\Http\Controllers\admin\ReporteController;
use App\Http\Controllers\admin\RegistroController;
use App\Http\Controllers\admin\DarSalidaController;
use App\Http\Controllers\admin\VisitanteController;
use App\Http\Controllers\admin\ResidenteController;
use App\Http\Controllers\admin\LocalidadController;
use App\Http\Controllers\admin\EstadoResidenteController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('theme/lte/layout');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* rutas de sector */
Route::middleware('auth')->prefix('sector/')
->name('sector.')
->controller(SectorController::class)
->group(function() {
  Route::post('store', 'store')->name('guardar');     
  Route::delete('destroy{sector}', 'destroy')->name('eliminar');
  Route::get('edit{sector}', 'edit')->name('editar');
  Route::put('update{sector}', 'update')->name('actualizar');
  Route::get('listar', 'listar')->name('listar');
});

/* rutas de puerta */
Route::middleware('auth')->prefix('puerta/')
->name('puerta.')
->controller(PuertaController::class)
->group(function() {
  Route::post('store', 'store')->name('guardar');
  Route::delete('destroy{puerta}', 'destroy')->name('eliminar');
  Route::get('listar', 'listar')->name('listar');
});

/* rutas de edificioPuerta */
Route::view('sectorPuerta', 'admin/ubicacion/sectorPuerta/index')->name('sectorPuerta')->middleware('auth');

/* rutas de localidad */
Route::middleware('auth')->prefix('localidad/')
->name('localidad.')
->controller(LocalidadController::class)
->group(function () {
  Route::get('index', 'index')->name('localidad');
  Route::post('store', 'store')->name('guardar');
  Route::delete('destroy{localidad}', 'destroy')->name('eliminar');
  Route::get('listar', 'listar')->name('listar');
});

/* rutas de residente */
Route::middleware('auth')->prefix('residente/')
->name('residente.')
->controller(ResidenteController::class)
->group(function () {
  Route::get('index', 'index')->name('residente');
  Route::post('store', 'store')->name('guardar');
  Route::get('{residente}/edit', 'edit')->name('editar');
  Route::match(array('PUT', 'PATCH'),'update{residente}', 'update')->name('actualizar');
  Route::delete('desactivar{residente}', 'desactivar')->name('desactivar');
  Route::get('sectores', 'sectores')->name('sectores');
  Route::get('localidades', 'localidades')->name('localidades');
  Route::get('listar', 'listar')->name('listar');
});

/* rutas de visitante */
Route::middleware('auth')->prefix('visitante/')
->name('visitante.')
->controller(VisitanteController::class)
->group(function () {
  Route::get('index', 'index')->name('visitante');
  Route::post('store', 'store')->name('guardar');
  Route::get('{visitante}/edit', 'edit')->name('editar');
  Route::match(array('PUT', 'PATCH'),'update{visitante}', 'update')->name('actualizar');
  Route::delete('desactivar{visitante}', 'desactivar')->name('desactivar');
  Route::get('listar', 'listar')->name('listar');
});

/* rutas de registro */
Route::middleware('auth')->prefix('registro/')
->name('registro.')
->controller(RegistroController::class)
->group(function () {
  Route::get('index', 'index')->name('registro');
  Route::post('store', 'store')->name('guardar');
  Route::get('residentes{page?}', 'residentes')->name('residentes');
  Route::get('registros{page?}',  'registros')->name('registros');
  Route::get('visitante{page?}',  'visitantes')->name('visitantes');
  Route::get('puertas{page?}',    'puertas')->name('puertas');
  Route::get('autoriza{page?}',   'autoriza')->name('autoriza');
  Route::get('ingresa{page?}',    'ingresa')->name('ingresa');
});

/* rutas de darSalida */
Route::middleware('auth')->prefix('darSalida/')
->name('darSalida.')
->controller(DarSalidaController::class)
->group(function () {
  Route::get('index', 'index')->name('index');
  Route::get('visitantes', 'visitantes')->name('visitantes');
  Route::post('darSalida', 'darSalida')->name('darSalida');
});

/* rutas de estadoResidente */
Route::middleware('auth')->prefix('estadoResidente/')
->name('estadoResidente.')
->controller(EstadoResidenteController::class)
->group(function () {
  Route::get('index', 'index')->name('index');
  Route::get('residentes/{id}', 'residentes')->name('residentes');
  Route::get('update', 'update')->name('update');
});

/* rutas de reporte */
Route::middleware('auth')->prefix('reporte/')
->name('reporte.')
->controller(ReporteController::class)
->group(function () {
  Route::get('index/{clave}', 'index')->name('index');
  Route::get('reportes', 'reportes')->name('reportes');
});