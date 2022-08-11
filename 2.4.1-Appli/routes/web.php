<?php

use App\Http\Controllers\UserController;
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

Route::get('/login',[UserController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login',[UserController::class, 'postLogin'])->name('postLogin');

Route::get('/register', [UserController::class, 'getRegister'])->name('register')->middleware('guest');
Route::post('/register', [UserController::class, 'postRegister'])->name('postRegister');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/list-users', [UserController::class, 'allUsers'])->name('listUsers');

    Route::get('/search', [UserController::class, 'searchUser'])->name('search');

    Route::get('/add-user', [UserController::class, 'getAddUser'])->name('addUser');
    Route::post('/add-user', [UserController::class, 'postAddUser'])->name('postAddUser');

    Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('editUser');
    Route::post('/update-user/{id}', [UserController::class, 'updateUser'])->name('updateUser');

    Route::post('/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
