<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

// middleware
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'login'])->name('login');
    Route::post('/', [AdminController::class, 'postLogin'])->name('p_login');
    Route::get('logout', [AdminController::class, 'logOut'])->name('logout');

    Route::get('register', [AdminController::class, 'register'])->name('register');
    Route::get('recover-pass', [AdminController::class, 'recoverPass'])->name('recover_pass');

    Route::get('index', [AdminController::class, 'index'])->name('index');

    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('users/add', [AdminController::class, 'addUser'])->name('add_user');
    Route::post('users/add', [AdminController::class, 'pAddUser'])->name('p_add_user');
    Route::get('users/edit/{id}', [AdminController::class, 'editUser'])->name('edit_user');
    Route::post('users/edit', [AdminController::class, 'pEditUser'])->name('p_edit_user');
    Route::get('users/search', [AdminController::class, 'searchUser'])->name('search_user');
    Route::get('users/delete', [AdminController::class, 'deleteUser'])->name('delete_user');

});
