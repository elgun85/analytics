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
    Route::get('/dataTable', [HomeControlller::class, 'dataTable'])->name('dataTable');

                         /*Finance*/


                         /*Analyse*/

    Route::get('/ixa', [AnalyseController::class, 'ixa'])->name('ixa');
    Route::get('/dp', [AnalyseController::class, 'dp'])->name('dp');
    Route::get('/hm', [AnalyseController::class, 'hm'])->name('hm');
    Route::get('/ml', [AnalyseController::class, 'ml'])->name('ml');
    Route::get('/mld', [AnalyseController::class, 'mld'])->name('mld');



                        /*Finance*/
    Route::get('/data_montly', [FinanceController::class, 'dmc'])->name('dmc');
    Route::get('/data_montly(FH)', [FinanceController::class, 'dmfh'])->name('dmfh');
    Route::get('/data_montly(Nazirlik)', [FinanceController::class, 'dmn'])->name('dmn');
    Route::get('/edv_siz_senedlesme', [FinanceController::class, 'edvs'])->name('edvs');
    Route::get('/edv_siz_siyahi', [FinanceController::class, 'edv'])->name('edv');



});











/*Route::get('/blank',[HomeControlller::class,'blank'])->name('blank');*/



/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');*/


require __DIR__.'/auth.php';
