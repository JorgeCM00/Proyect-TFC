<?php

use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\CestaController;
use App\Http\Controllers\ProductosController;
use App\Http\Middleware\LocaleCookieMiddleware;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

//Esto es para el multiidioma.
Route::get('/locale/{locale}',function($locale){
    return redirect()->back()->withCookie('locale',$locale);
});
Route::middleware(LocaleCookieMiddleware::class)->group(function(){
    require __DIR__ . '/auth.php';

//****************************************//

Route::get('/', [ProductosController::class,'mostrarTienda']);
Route::get('/perfil/{id}',[PerfilController::class,'verPerfil'])->middleware('auth');
Route::get('/perfil/edicion/{id}',[PerfilController::class,'editarPerfil'])->middleware('auth')->name("editaPerfil");
Route::post('/perfil/edicion/{id}',[PerfilController::class,'edicion'])->middleware('auth');
Route::get('/afiliarse/{id}',[AfiliadoController::class,'afiliar'])->middleware('auth');
Route::post('/afiliarse/{id}',[AfiliadoController::class,'afiliarse'])->middleware('auth');
Route::post('upload',[PerfilController::class,'upload'])->middleware('auth');
Route::get('/afiliados',[AfiliadoController::class,'mostrarAfiliados']);
Route::get('/crearProducto/{id}',[ProductosController::class,'crearProductos'])->middleware('auth')->middleware('afiliado');
Route::post('/crearProducto/{id}',[ProductosController::class,'creacionProducto'])->middleware('auth')->middleware('afiliado');
Route::post('subir',[ProductosController::class,'subir'])->middleware('auth')->middleware('afiliado');
Route::post('editar',[ProductosController::class,'editar'])->middleware('auth')->middleware('afiliado');
Route::get('tienda',[ProductosController::class,'mostrarTienda']);
Route::get('misProductos/{id}',[ProductosController::class,'listaProductos'])->middleware('auth')->middleware('afiliado');
Route::get('misProductos/gestionarProducto/{id}',[ProductosController::class,'gestionarProducto'])->middleware('auth')->middleware('afiliado');
Route::post('/gestionProducto/productoEditado/{id}',[ProductosController::class,'editarProducto'])->middleware('auth')->middleware('afiliado');
Route::get('/gestionProducto/productoBorrado/{id}',[ProductosController::class,'borrar'])->middleware('auth')->middleware('afiliado');
Route::get('darseDeBaja/{id}',[AfiliadoController::class,'darseDeBaja'])->middleware('auth')->middleware('afiliado');
Route::get('verPerfil/{id}',[PerfilController::class,'verPerfil']);
Route::get('verProductoAfiliado/{id}',[ProductosController::class,'productosAfiliado']);
Route::get('cesta/{id}',[CestaController::class,'addProducto'])->middleware('auth');
Route::get('verCesta/{id}',[CestaController::class,'obtenerCesta'])->middleware('auth');
Route::get('/cesta/delete/{id}',[CestaController::class,'borrarProductoCesta'])->middleware('auth');
Route::post('/comprar/{id}',[CestaController::class,'pagar'])->middleware('auth');
Route::get('/QuienesSomos',function(){
    return view('QuienesSomos');
});
});