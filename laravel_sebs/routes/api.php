<?php
use App\Http\Controllers\Clientesclientes;
use App\Http\Controllers\AlumnosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

route::get('/alumnos',[alumnoscontroller::class, "index"]);



route::get('/clientes',[clientesclientes::class, "lista"]);
Route::get('/clientes/{id}',[Clientesclientes::class, 'cliente']); //obtiene un cliente
Route::post('/clientes ' ,[Clientesclientes::class,'crear']); //creando un cliente
Route::put('/clientes/{id}',[Clientesclientes::class, 'actualizar']); //actualiza un cliente
Route::delete('/clientes/{id}',[Clientesclientes::class, 'eliminar']); //elimina un cliente
Route::PATCH('/clientes/{cliente}',[Clientesclientes::class, 'actualización_parcial']); //elimina un cliente9