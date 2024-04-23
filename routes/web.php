<?php

use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. Todas
| estas rutas son cargadas por RouteServiceProvider y todas ellas serán
| asignadas al grupo de middleware "web". ¡Haz algo genial!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/records/sorteo', [RecordController::class, 'sorteo'])->name('records.sorteo');
Route::resource('records', RecordController::class)->except(['show']);
Route::post('/records/selectWinner', [RecordController::class, 'selectWinner'])->name('records.selectWinner');
Route::get('/export-records', [RecordController::class, 'export'])->name('export.records');
