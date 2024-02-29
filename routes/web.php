<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User77Controller;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Routing untuk proses autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/', [User77Controller::class, 'loginView77'])->middleware('isLogged');
Route::get('/logout77', [User77Controller::class, 'logout77']);
Route::post('/register77', [User77Controller::class, 'register77']);
Route::post('/login77', [User77Controller::classphp , 'login77']);
Route::put('/lupaPassword77', [User77Controller::class, 'lupaPassword77']);
Route::get('/user/profile77', [User77Controller::class, 'userView77'])->middleware('isUser');
Route::get('/register77', [User77Controller::class, 'registerView77']);
Route::get('/admin/dashboard77', [User77Controller::class, 'adminView77'])->middleware('isAdmin');
Route::get('/admin/agama77', [User77Controller::class, 'agamaView77'])->middleware('isAdmin');
Route::get('/user/lupaPassword77', [User77Controller::class, 'lupaPasswordView77']);
Route::put('/updateData77', [User77Controller::class, 'updateData77']);
Route::put('/setIsAktif77/{id}', [User77Controller::class, 'setIsAktif77'])->middleware('isAdmin');
Route::get('/detailUser77/{id}', [User77Controller::class, 'detailUser77']);
Route::post('/tambahAgama77', [User77Controller::class, 'tambahAgama77']);
Route::put('/updateAgama77/{id}', [User77Controller::class, 'updateAgama77']);
Route::get('/hapusAgama77/{id}', [User77Controller::class, 'hapusAgama77']);
