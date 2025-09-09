<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return redirect()->route('proyectos.index');
});

// CRUD de proyectos
Route::resource('proyectos', ProyectoController::class);
