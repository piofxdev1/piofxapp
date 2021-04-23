<?php

use App\Http\Controllers\TemplateController;

Route::get('/template',[TemplateController::class, 'public_index'])->name('Template.public_index');
Route::get('/template/{slug}',[TemplateController::class, 'public_show'])->name('Template.public_show');

Route::get('/admin/template/create', [TemplateController::class, 'create'])->name('Template.create');
Route::post('/admin/template/create', [TemplateController::class, 'store'])->name('Template.store');
Route::get('/admin/template/edit/{slug}', [TemplateController::class, 'edit'])->name('Template.edit');
Route::put('/admin/template/edit/{slug}', [TemplateController::class, 'update'])->name('Template.update');
Route::delete('/admin/template/delete/{slug}', [TemplateController::class, 'delete'])->name('Template.delete');








