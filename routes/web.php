<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulationController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SimulationController::class, 'index'])->name('simulate');
Route::post('/simulate', [SimulationController::class, 'runSimulation'])->name('simulate.run');

// CRUD Routes
Route::post('/prizes', [SimulationController::class, 'store'])->name('prizes.store');
Route::get('/prizes/edit/{id}', [SimulationController::class, 'edit'])->name('prizes.edit');
Route::put('/prizes/update/{id}', [SimulationController::class, 'update'])->name('prizes.update');
Route::post('/prizes/delete/{id}', [SimulationController::class, 'destroy'])->name('prizes.delete');