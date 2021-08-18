<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\HomeController as HomController;
use App\Http\Controllers\Admin\ArticuloController;
use App\Http\Controllers\Admin\OngController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::namespace('')->prefix('admin')
  ->middleware(['auth', 'verified', 'rol.admin'])
  ->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::apiResource('/articulos', ArticuloController::class );
    Route::apiResource('/planes', PlanController::class );
    Route::apiResource('/categorias', CategoriaController::class );
    Route::apiResource('/ongs', OngController::class );
  });
  
  Route::post('uploadCategoria', [UploadController::class, 'handle']);
  Route::post('uploadOng', [UploadController::class, 'ong']);
  
  
  

  