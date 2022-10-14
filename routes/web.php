<?php

use App\Http\Controllers\admin\LocalidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PuertaController;
use App\Http\Controllers\admin\ResidenteController;
use App\Http\Controllers\admin\SectorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('theme/lte/layout');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* rutas de sector */
Route::resource('sector', App\Http\Controllers\admin\SectorController::class)->names([
    'store' => 'sector.guardar',
    'destroy' => 'sector.eliminar',
])->middleware('auth');
Route::get('sector.listar{page?}', [SectorController::class, 'listar'])->name('sector.listar')->middleware('auth');
/* rutas de sector */
/* rutas de puerta */
Route::resource('puerta', App\Http\Controllers\admin\PuertaController::class)->names([
    'store' => 'puerta.guardar',
    'destroy' => 'puerta.eliminar',
])->middleware('auth');
Route::get('puerta.listar{page?}', [PuertaController::class, 'listar'])->name('puerta.listar')->middleware('auth');;
/* rutas de puerta */
/* rutas de edificioPuerta */
Route::view('sectorPuerta', 'admin/ubicacion/sectorPuerta/index')->name('sectorPuerta')->middleware('auth');
/* rutas de edificioPuerta */
/* rutas de localidad */
Route::resource('localidad', App\Http\Controllers\admin\localidadController::class)->names([
    'index' => 'localidad',
    'store' => 'localidad.guardar',
    'edit' => 'localidad.editar',
    'update' => 'localidad.actualizar',
    'destroy' => 'localidad.eliminar',
])->middleware('auth');
Route::get('localidad.listar{page?}', [LocalidadController::class, 'listar'])->name('localidad.listar');
Route::get('localidad.checkSector', [LocalidadController::class, 'checkSector'])->name('localidad.checkSector');
/* rutas de localidad */
/* rutas de residente */
Route::resource('residente', App\Http\Controllers\admin\residenteController::class)->names([
    'index' => 'residente',
    'store' => 'residente.guardar',
    'edit' => 'residente.editar',
    'update' => 'residente.actualizar',
    'destroy' => 'residente.eliminar',
])->middleware('auth');
Route::get('residente.listar{page?}', [ResidenteController::class, 'listar'])->name('residente.listar');
Route::get('residente.sectorBusqueda', [ResidenteController::class, 'sectorBusqueda'])->name('residente.sectorBusqueda');
Route::get('residente.localidadBusqueda', [ResidenteController::class, 'localidadBusqueda'])->name('residente.localidadBusqueda');
Route::get('residente.localidad', [ResidenteController::class, 'localidad'])->name('residente.localidad');
/* rutas de residente */