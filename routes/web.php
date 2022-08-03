<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\BackendController::class, 'index'])->name('home');

################ UserController ############

Route::prefix('backend/user')->name('backend.user.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\UserController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\UserController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\UserController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\UserController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\UserController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\UserController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\UserController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\UserController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\UserController::class, 'update'])->name('update');
});



################ RoleController ############

Route::prefix('backend/role')->name('backend.role.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\RoleController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\RoleController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\RoleController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\RoleController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\RoleController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\RoleController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\RoleController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\RoleController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\RoleController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\RoleController::class, 'update'])->name('update');
});


