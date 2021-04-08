<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

// Users-routes

Route::get('/', [UsersController::class, 'index'])->name('users.index');

Route::get('/{user}/add-color', [UsersController::class, 'addUserColor'])->name('colors.add-user-color');
Route::get('/{user}/delete-color', [UsersController::class, 'deleteUserColor'])->name('colors.delete-user-color');

Route::get('/{user}/add-color/{color}', [UsersController::class, 'addNewUserColor'])->name('colors.add-new-user-color');
Route::get('/{user}/delete-color/{color}', [UsersController::class, 'deleteExistingUserColor'])->name('colors.delete-existing-user-color');
Route::get('/{user}/change-color/{color}', [UsersController::class, 'changeUserHexValue'])->name('colors.change-user-color');


// REST-API

Route::put('/add-user/{name}/{email}/{password}/{hex_value}', [UsersController::class, 'addUser']);
Route::delete('/delete-user/{email}', [UsersController::class, 'deleteUser']);
Route::get('/get-user-color/{email}', [UsersController::class, 'getUserColor']);
Route::get('/get-users', [UsersController::class, 'getUsers']);