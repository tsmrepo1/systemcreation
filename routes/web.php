<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\MasterTaskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LiveviewController;
use App\Http\Controllers\EmscoreController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('register', function() {
//     return redirect(route('register'));
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [DashboardController::class, "dashboard"])->name('dashboard');

    Route::resource('mastertasks', MasterTaskController::class);
    Route::resource('members', UserController::class);
    Route::resource('team', TeamController::class);
    Route::resource('teammembers', TeamMemberController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('employeetasks', EmployeeTaskController::class);  
    Route::get('/emscore', [EmscoreController::class, "index"])->name('emscore');  
    Route::post('/dateemscore', [EmscoreController::class, "more_filter"])->name('datewise.emscore');
    Route::get('/checkrealtimeemployeetask-view', [LiveviewController::class, "index"])->name('checkreal'); 
    Route::post('/details-run', [LiveviewController::class, "showrunning"])->name('running.details');
    Route::get('/update-revision-date', [LiveviewController::class, "revupdate"])->name('rev_date-modify');
    Route::get('/log-all-users', [LiveviewController::class, "userslog"])->name('log-fetch');
    Route::post('/delegationupdate/{id}', [LiveviewController::class, "doupdate"])->name('delegationupdate');
});
