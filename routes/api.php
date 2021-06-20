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

Route::post('procedimentos', 'App\Http\Controllers\ProcedimentoController@register');
Route::get('procedimentos', 'App\Http\Controllers\ProcedimentoController@getAll');
Route::get('procedimento/{id}', 'App\Http\Controllers\ProcedimentoController@getById');

Route::post('servicos', 'App\Http\Controllers\ServicoController@register');
Route::get('servicos', 'App\Http\Controllers\ServicoController@getAll');