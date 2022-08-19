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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('frontend.home');
Route::get('/home', [App\Http\Controllers\BackendController::class, 'index'])->name('home');
Route::get('/donor/register', [\App\Http\Controllers\Frontend\DonorController::class, 'registerForm'])->name('frontend.donor.register');
Route::get('/donor/login', [\App\Http\Controllers\Frontend\DonorController::class, 'login'])->name('frontend.donor.login');
Route::post('/donor/doregister', [App\Http\Controllers\Frontend\DonorController::class, 'register'])->name('frontend.donor.doregister');
Route::get('/donor/home', [\App\Http\Controllers\Frontend\DonorController::class, 'home'])->name('frontend.donor.home');
Route::get('/donor/wantdonate', [\App\Http\Controllers\Frontend\DonorController::class, 'donate'])->name('frontend.donor.wantdonate');
Route::post('/donor/donate', [App\Http\Controllers\Frontend\DonorController::class, 'dodonate'])->name('frontend.donor.donate');
Route::get('/donor/bloodbank', [App\Http\Controllers\Frontend\DonorController::class, 'bloodbank'])->name('frontend.donor.bloodbank');
Route::get('/donor/availability', [App\Http\Controllers\Frontend\DonorController::class, 'bloodAvailable'])->name('frontend.donor.availability');
################ BloodBankController ############

Route::prefix('backend/bloodbank')->name('backend.bloodbank.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\BloodBankController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\BloodBankController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\BloodBankController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\BloodBankController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\BloodBankController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\BloodBankController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\BloodBankController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\BloodBankController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\BloodBankController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\BloodBankController::class, 'update'])->name('update');
});


################ LocationController ############

Route::prefix('backend/location')->name('backend.location.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\LocationController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\LocationController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\LocationController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\LocationController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\LocationController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\LocationController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\LocationController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\LocationController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\LocationController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\LocationController::class, 'update'])->name('update');
});

################ BankTypeController ############

Route::prefix('backend/banktype')->name('backend.banktype.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\BankTypeController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\BankTypeController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\BankTypeController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\BankTypeController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\BankTypeController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\BankTypeController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\BankTypeController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\BankTypeController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\BankTypeController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\BankTypeController::class, 'update'])->name('update');
});

################ BloodGroupController ############

Route::prefix('backend/bloodgroup')->name('backend.bloodgroup.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\BloodGroupController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\BloodGroupController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\BloodGroupController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\BloodGroupController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\BloodGroupController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\BloodGroupController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\BloodGroupController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\BloodGroupController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\BloodGroupController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\BloodGroupController::class, 'update'])->name('update');
});

################ BloodDonationController ############

Route::prefix('backend/blooddonation')->name('backend.blooddonation.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\BloodDonationController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\BloodDonationController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\BloodDonationController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\BloodDonationController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\BloodDonationController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\BloodDonationController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\BloodDonationController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\BloodDonationController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\BloodDonationController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\BloodDonationController::class, 'update'])->name('update');
});

################ BloodpouchController ############

Route::prefix('backend/bloodpouch')->name('backend.bloodpouch.')->group(function () {
    //to show deleted data
    //it should be given priority show kept on top
    Route::get('/trash', [\App\Http\Controllers\Backend\BloodPouchController::class, 'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}', [\App\Http\Controllers\Backend\BloodPouchController::class, 'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}', [\App\Http\Controllers\Backend\BloodPouchController::class, 'permanentDelete'])->name('force_delete');

    //to create form data
    Route::get('/create', [\App\Http\Controllers\Backend\BloodPouchController::class, 'create'])->name('create');
    //to store form data
    Route::post('/', [\App\Http\Controllers\Backend\BloodPouchController::class, 'store'])->name('store');
    // to display form data
    Route::get('/', [\App\Http\Controllers\Backend\BloodPouchController::class, 'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}', [\App\Http\Controllers\Backend\BloodPouchController::class, 'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}', [\App\Http\Controllers\Backend\BloodPouchController::class, 'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit', [\App\Http\Controllers\Backend\BloodPouchController::class, 'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}', [\App\Http\Controllers\Backend\BloodPouchController::class, 'update'])->name('update');
});
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
