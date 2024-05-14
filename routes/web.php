<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\appcontroller;
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

Route::group(['prefix' => 'account'],function() {
    
    //guest middleware
    Route::middleware(['prevent-back-history','guest'])->group( function() {
         Route::get('/login',[LoginController::class,'index'])->name('account.login');
         Route::get('/register',[LoginController::class,'register'])->name('account.register');
         Route::post('/process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
         Route::post('/authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
        
    
    });
    
    //authentiated middlewar
        
   
    Route::middleware(['prevent-back-history','auth'])->group( function() {
        Route::get('/logout',[LoginController::class,'logout'])->name('account.logout');
        Route::get('/dashboard',[LoginController::class,'dashboard'])->name('account.dashboard');

        
    });
    
    
    
});

// Route::get('/account/logout',[LoginController::class,'logout'])->name('account.logout');
Route::get('/verify',[LoginController::class,'index'])->name('verify');

// Route::get('/account/dashboard',[LoginController::class,'dashboard'])->name('account.dashboard');

// Route::get('/account/profile', function () {
//     return view('register');
// });