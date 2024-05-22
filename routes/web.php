<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControlller;
use App\Http\Controllers\LoginController;

//Route::view('/', 'welcome');

Route::get('/',[LoginController::class,'login'])->name('logins');
Route::get('/Register',[LoginController::class,'register'])->name('registers');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/Profile',[LoginController::class,'profile'])->name('profiles');


/*Route::get('/blank',[HomeControlller::class,'blank'])->name('blank');*/



/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');*/




/*Admin*/
Route::group(['middleware' => ['auth','isAdmin']],function ()
{
    Route::get('/dashboard', [HomeControlller::class, 'dashboard'])->name('dashboard');

});

require __DIR__.'/auth.php';
