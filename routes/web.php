<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HistorybarangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProdukController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ProdukController::class, 'index']);

Route::get('/History',[HistoryController::class, 'getH']);

Route::get('/Product',[ProdukController::class, 'stock']);

Route::post('/Tambah-Produk',[ProdukController::class, 'addProduct']);

Route::post('/Tambah-Cart/{id}',[CartController::class, 'AddCart']);

Route::get('/Delete-Cart/{id}',[CartController::class, 'D_Cart']);

Route::get('/Transaction', [HistoryController::class, 'CreateH']);

Route::get('/Print_out/{id}', [HistoryController::class, 'print_out']);

Route::post('/Update-Product/{id}', [ProdukController::class, 'update_prod']);

Route::post('/Tambah-Stock/{id}',[ProdukController::class, 'tambah_Stok']);

Route::get('Delete/{id}', [ProdukController::class, 'delete_prod']);

Route::get('Delete-All',[CartController::class, 'delete_all']);

Route::get('History/Detail/{id}', [HistoryController::class, 'getdetail']);

Route::get('HistoryBarang', [HistorybarangController::class, 'getHB']);
