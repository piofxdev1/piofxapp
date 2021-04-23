<?php

use App\Http\Controllers\UserManagement\UserManagerController;

Route::get('/admin/users', [UserManagerController::class, 'index'])->middleware('auth')->name('UserManager.index');
Route::get('/admin/user/create', [UserManagerController::class, 'create'])->middleware('auth')->name('UserManager.create');
Route::post('/admin/user/create', [UserManagerController::class, 'store'])->middleware('auth')->name('UserManager.store');
Route::get('/admin/user/edit/{id}', [UserManagerController::class, 'edit'])->middleware('auth')->name('UserManager.edit');
Route::put('/admin/user/update/{id}', [UserManagerController::class, 'update'])->middleware('auth')->name('UserManager.update');
Route::delete('/admin/user/delete/{id}', [UserManagerController::class, 'destroy'])->middleware('auth')->name('UserManager.destroy');
Route::get('/admin/user/{name}', [UserManagerController::class, 'show'])->middleware('auth')->name('UserManager.show');

