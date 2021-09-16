<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\HomeController as HomController;
use App\Http\Controllers\Admin\OngController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\SubcategoriaController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\ProyectoController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Admin\ImagesCausasController;
use App\Http\Controllers\Admin\DonadorController;
use App\Http\Controllers\Admin\ImagesProyectoController;
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


Auth::routes();

Route::get('/', [HomController::class, 'index'])->name('home');
Route::get('causas/{id}', [HomController::class, 'causas']);
Route::get('registrarse', [HomController::class, 'registrar']);
Route::get('usuario/{email}',[HomController::class, 'usuario']);
Route::get('proyecto/{id}',[ProyectoController::class, 'ver'])->name('proyecto');



Route::namespace('')->prefix('admin')
  ->middleware(['auth', 'verified', 'rol.admin'])
  ->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::apiResource('/planes', PlanController::class );
    Route::apiResource('/categorias', CategoriaController::class );
    Route::apiResource('/ongs', OngController::class );
    Route::apiResource('/subcategorias', SubcategoriaController::class );
    Route::apiResource('/proyectos', ProyectoController::class );
    Route::apiResource('/imagenes', ImagesController::class );
    Route::apiResource('/imagenesCausas', ImagesCausasController::class );
    Route::apiResource('/imagenesProyecto', ImagesProyectoController::class );
    Route::post('proyectoUpdate/{tipo}', [ProyectoController::class, 'actualizar']);
    
    Route::group(['prefix' => 'sponsor'], function () {
      Route::get('/{tipo}', [SponsorController::class, 'index']);
      Route::get('/{tipo}/{id}', [SponsorController::class, 'show']);
      Route::post('/{tipo}', [SponsorController::class, 'store']);
      Route::put('/{id}', [SponsorController::class, 'update']);
      Route::delete('/{id}', [SponsorController::class, 'destroy']);
    });
    
    
  });
  // Google Login
  Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
  Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
  // Facebook Login
  Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
  Route::get('/login/facebook/callback', [App\Http\Auth\Controllers\LoginController::class, 'handleFacebookCallback']);
  
  Route::apiResource('/donadores', DonadorController::class );
  Route::post('uploadCategoria', [UploadController::class, 'handle']);
  Route::post('uploadOng', [UploadController::class, 'ong']);
  Route::post('uploadSponsor', [UploadController::class, 'sponsor']);
  Route::get('causa/{id}',[ProyectoController::class, 'obtenerPaginado']);
  Route::get('destacados',[ProyectoController::class, 'destacados']);
  Route::get('proyectos/{id}',[ProyectoController::class, 'show']);
  
  
  Route::get('imagenes', [ImagesController::class, 'index']);
  Route::get('imagenesCausas', [ImagesCausasController::class, 'index']);
  Route::get('imagenesProyecto', [ImagesProyectoController::class, 'index']);
  Route::get('sponsor/{tipo}', [SponsorController::class, 'index']);
  Route::get('categorias', [CategoriaController::class, 'index']);
  Route::get('proyecto/ongs/{id}', [OngController::class, 'show']);
  
  
  

  