<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DetailController;


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

//dashboard
Route::get('/login', [LoginController::class, 'login'])->name('login');

//login
Route::get('/',[LoginController::class, 'login'])->name('login');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
Route::post('auth',[LoginController::class, 'auth'])->name('auth');// Untuk login

//pelanggan
Route::resource('pelanggan', PelangganController::class)->middleware('auth');//melempar user yang belum login bagi yang belum login
Route::get('export_pdf_pelanggan',[PelangganController::class, 'export_pdf'])->name('export_pdf_pelanggan');//menambah route buku pdf
Route::get('export_excel_pelanggan',[PelangganController::class, 'export_excel'])->name('export_excel_pelanggan');//menambah route export excel
Route::post('import_excel_buku',[PelangganController::class, 'import_excel'])->name('import_excel_buku')->middleware('role:administrator');//menambah route import excel

//produk
Route::resource('produk', ProdukController::class)->middleware('auth');//melempar user yang belum login bagi yang belum login
Route::get('export_pdf_produk',[ProdukController::class, 'export_pdf'])->name('export_pdf_produk');//menambah route buku pdf
Route::get('export_excel_produk',[ProdukController::class, 'export_excel'])->name('export_excel_produk');//menambah route export excel


//penjualan
Route::resource('penjualan', PenjualanController::class);//melempar user yang belum login bagi yang belum login
Route::get('export_pdf_penjualan',[PenjualanController::class, 'export_pdf'])->name('export_pdf_penjualan');//menambah route buku pdf

//register
//register
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('export_excel_penjualan',[PenjualanController::class, 'export_excel'])->name('export_excel_penjualan');//menambah route export excel

//detail penjualan
Route::Resource('detail', DetailController::class);