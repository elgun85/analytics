<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControlller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\AnalyseController;

//Route::view('/', 'welcome');

Route::get('/',[LoginController::class,'login'])->name('logins');
Route::get('/Register',[LoginController::class,'register'])->name('registers');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/Profile',[LoginController::class,'profile'])->name('profiles');







                        /*Admin*/
Route::group(['middleware' => ['auth','isAdmin']],function ()
{
    Route::get('/dashboard', [HomeControlller::class, 'dashboard'])->name('dashboard');
    Route::get('/telnet', [HomeControlller::class, 'telnet'])->name('telnet');

                         /*Finance*/


                         /*Analyse*/

    Route::get('/ixa', [AnalyseController::class, 'ixa'])->name('ixa');
    Route::get('/dp', [AnalyseController::class, 'dp'])->name('dp');
    Route::get('/hm', [AnalyseController::class, 'hm'])->name('hm');
    Route::get('/ml', [AnalyseController::class, 'ml'])->name('ml');
    Route::get('/mld', [AnalyseController::class, 'mld'])->name('mld');

});











/*Route::get('/blank',[HomeControlller::class,'blank'])->name('blank');*/



/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');*/


require __DIR__.'/auth.php';
