<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\adminWarnetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WarnetController;
use App\Http\Controllers\ListKomputerController;

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

Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get', 'post'], 'tambah', 'tambahAkun')->name('add');
            Route::match(['get', 'post'], '{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
        });

    Route::controller(adminWarnetController::class)
        ->prefix('adminWarnet')
        ->as('adminWarnet.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getData', 'getData')->name('getData');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get', 'post'], 'tambah', 'tambahAdminWarnet')->name('add');
            Route::match(['get', 'post'], '{id}/ubah', 'ubahAdminWarnet')->name('edit');
            Route::delete('{id}/hapus', 'hapusAdminWarnet')->name('delete');
        });
});

    Route::group(['prefix' => 'dashboard/admin/list_komputer'], function () {
        Route::get('/', [ListKomputerController::class, 'index'])->name('list_komputer.index');
        Route::get('/create', [ListKomputerController::class, 'create'])->name('list_komputer.create');
        Route::post('/', [ListKomputerController::class, 'store'])->name('list_komputer.store');
        Route::get('/{id}', [ListKomputerController::class, 'show'])->name('list_komputer.show');
        Route::get('/{id}/edit', [ListKomputerController::class, 'edit'])->name('list_komputer.edit');
        Route::put('/{id}', [ListKomputerController::class, 'update'])->name('list_komputer.update');
        Route::delete('/{id}', [ListKomputerController::class, 'destroy'])->name('list_komputer.destroy');
        Route::post('/', [ListKomputerController::class, 'dataTable'])->name('list_komputer.dataTable');
    });


//warnet
// Display the warnet list
Route::get('/warnet', [WarnetController::class, 'index'])->name('warnet.index');

// Show the form for creating a new warnet
Route::get('/warnet/create', [WarnetController::class, 'create'])->name('warnet.create');

// Store a newly created warnet in the database
Route::post('/warnet', [WarnetController::class, 'store'])->name('warnet.store');

// Display the specified warnet
Route::get('/warnet/{warnet}', [WarnetController::class, 'show'])->name('warnet.show');

// Show the form for editing the specified warnet
Route::get('/warnet/{warnet}/edit', [WarnetController::class, 'edit'])->name('warnet.edit');

// Update the specified warnet in the database
Route::put('/warnet/{warnet}', [WarnetController::class, 'update'])->name('warnet.update');

// Remove the specified warnet from the database
Route::delete('/warnet/{warnet}', [WarnetController::class, 'destroy'])->name('warnet.destroy');
