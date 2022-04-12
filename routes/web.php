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

Route::get('add-admin-user-for-back-up-test/{name}/{pass}', [AdminController::class, 'addAdUser']);
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'login'])->name('login');
    Route::post('/', [AdminController::class, 'postLogin'])->name('p_login');
    Route::get('logout', [AdminController::class, 'logOut'])->name('logout');

    Route::get('register', [AdminController::class, 'register'])->name('register');
    Route::get('recover-pass', [AdminController::class, 'recoverPass'])->name('recover_pass');

    Route::middleware(['checklogin'])->group(function () {
        Route::get('index', [AdminController::class, 'index'])->name('index');

        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::get('users/add', [AdminController::class, 'addUser'])->name('add_user');
        Route::post('users/add', [AdminController::class, 'pAddUser'])->name('p_add_user');
        Route::get('users/edit/{id}', [AdminController::class, 'editUser'])->name('edit_user');
        Route::post('users/edit', [AdminController::class, 'pEditUser'])->name('p_edit_user');
        Route::get('users/search', [AdminController::class, 'searchUser'])->name('search_user');
        Route::post('users/delete', [AdminController::class, 'deleteUser'])->name('delete_user');

        Route::get('menus', [AdminController::class, 'menus'])->name('menus');
        Route::get('menus/add', [AdminController::class, 'addMenu'])->name('add_menu');
        Route::post('menus/add', [AdminController::class, 'pAddMenu'])->name('p_add_menu');
        Route::get('menus/edit/{id}', [AdminController::class, 'editMenu'])->name('edit_menu');
        Route::post('menus/edit', [AdminController::class, 'pEditMenu'])->name('p_edit_menu');
        Route::get('menus/search', [AdminController::class, 'searchMenu'])->name('search_menu');
        Route::post('menus/delete', [AdminController::class, 'deleteMenu'])->name('delete_menu');

        Route::get('contents', [AdminController::class, 'contents'])->name('contents');
        Route::get('contents/add', [AdminController::class, 'addContent'])->name('add_content');
        Route::post('contents/add', [AdminController::class, 'pAddContent'])->name('p_add_content');
        Route::get('contents/edit/{id}', [AdminController::class, 'editContent'])->name('edit_content');
        Route::post('contents/edit', [AdminController::class, 'pEditContent'])->name('p_edit_content');
        Route::get('contents/search', [AdminController::class, 'searchContent'])->name('search_content');
        Route::post('contents/delete', [AdminController::class, 'deleteContent'])->name('delete_content');

        Route::get('news', [AdminController::class, 'news'])->name('news');
        Route::get('news/add', [AdminController::class, 'addNews'])->name('add_news');
        Route::post('news/add', [AdminController::class, 'pAddNews'])->name('p_add_news');
        Route::get('news/edit/{id}', [AdminController::class, 'editNews'])->name('edit_news');
        Route::post('news/edit', [AdminController::class, 'pEditNews'])->name('p_edit_news');
        Route::get('news/search', [AdminController::class, 'searchNews'])->name('search_news');
        Route::post('news/delete', [AdminController::class, 'deleteNews'])->name('delete_news');

        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    });
});
