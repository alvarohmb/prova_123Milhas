<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Desafio 1
    Route::post('listar-voos', 'VoosController@listarVoos');

// Desafio 2
    Route::post('agrupar-voos', 'VoosController@agruparVoos');