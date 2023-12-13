<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\adminWarnetController;
use App\Exports\AdminWarnetExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WarnetController;
use App\Http\Controllers\ListKomputerController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\AdminWarnetAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataWarnetController;

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


Route::get('/login/admin', [AdminWarnetAuthController::class, 'showLoginForm'])->name('admin.login');

Route::post('/login/admin', [AdminWarnetAuthController::class, 'login_admin'])->name('loginAdmin');
Route::post('/logout/admin', [AdminWarnetAuthController::class, 'logout'])->name('logoutAdmin');

Route::group(['prefix' => '/admin'], function () {
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
            Route::match(['get', 'post'], '{id_adminWarnet}/ubah', 'ubahAdminWarnet')->name('edit');
            Route::delete('{id_adminWarnet}/hapus', 'hapusAdminWarnet')->name('delete');
            Route::get('/export', 'export')->name('export');
        });

    Route::controller(CustomerController::class)
        ->prefix('customer')
        ->as('customer.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getData', 'dataTable')->name('data');
            Route::get('showdata', 'dataTable')->name('dataTable');
            Route::match(['get', 'post'], 'tambah', 'tambahCustomer')->name('add');
            Route::match(['get', 'post'], '{id_customer}/ubah', 'ubahCustomer')->name('edit');
            Route::delete('{id_customer}/hapus', 'hapusCustomer')->name('delete');
        });

    Route::controller(ListKomputerController::class)
        ->prefix('dashboard/admin/list_komputer')
        ->as('list_komputer.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{id}/edit', 'edit')->name('edit');
            Route::put('{id}', 'update')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
            Route::match(['get', 'post'], 'export-pdf', 'exportPdf')->name('exportPdf');
        });

    // Route::controller(WarnetController::class)
    //     ->prefix('warnet')
    //     ->as('warnet.')
    //     ->group(function () {
    //         Route::get('/', 'index')->name('index');
    //         Route::get('/create','create')->name('create');
    //         Route::post('/', 'store')->name('store');
    //         Route::get('/{warnet}', 'show')->name('show');
    //         Route::get('/{warnet}/edit', 'edit')->name('edit');
    //         Route::put('/{warnet}','update')->name('update');
    //         Route::delete('/{warnet}','destroy')->name('destroy');
    //         Route::get('/data','dataTable')->name('dataTable');
    // });
})->middleware('checkrole:Admin');


Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::get('/', [adminWarnetController::class, 'dashboard'])->name('adminWarnet.dashboard');

    Route::controller(ListKomputerController::class)
        ->prefix('list_komputer')
        ->as('list_komputer.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{id}/edit', 'edit')->name('edit');
            Route::put('{id}', 'update')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
            Route::match(['get', 'post'], 'export-pdf', 'exportPdf')->name('exportPdf');
        })->middleware('checkrole:adminWarnet');

    // Route::controller(WarnetController::class)
    //     ->prefix('warnet')
    //     ->as('warnet.')
    //     ->group(function () {
    //         Route::get('/', 'index')->name('index');
    //         Route::get('/create','create')->name('create');
    //         Route::post('/', 'store')->name('store');
    //         Route::get('/{warnet}', 'show')->name('show');
    //         Route::get('/{warnet}/edit', 'edit')->name('edit');
    //         Route::put('/{warnet}','update')->name('update');
    //         Route::delete('/{warnet}','destroy')->name('destroy');
    //         Route::get('/data','dataTable')->name('dataTable');
    // });
})->middleware('checkrole:adminWarnet');


Route::get('/dataWarnet', [DataWarnetController::class, 'index'])->name('dashboard.dataWarnet');;



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

Route::post('/warnet/data', [WarnetController::class, 'dataTable'])->name('warnet.dataTable');
Route::match(['get', 'post'], 'warnet/export-pdf', [WarnetController::class, 'exportPdf'])->name('warnet.exportPdf');
