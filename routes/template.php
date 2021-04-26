<?php

use App\Http\Controllers\Template\TemplateController;
use App\Http\Controllers\Template\TemplateCategoryController;
use App\Http\Controllers\Template\TemplateTagController;


// Category Routes
Route::get("/admin/templates/categories", [TemplateCategoryController::class, "index"])->middleware('auth')->name("TemplateCategory.index");
Route::get("/admin/templates/category/create", [TemplateCategoryController::class, "create"])->middleware('auth')->name("TemplateCategory.create");
Route::post("/admin/templates/category/create", [TemplateCategoryController::class, "store"])->middleware('auth')->name("TemplateCategory.store");
Route::get("/admin/templates/category/{slug}/edit", [TemplateCategoryController::class, "edit"])->middleware('auth')->name("TemplateCategory.edit");
Route::put("/admin/templates/category/{id}", [TemplateCategoryController::class, "update"])->middleware('auth')->name("TemplateCategory.update");
Route::delete("/admin/templates/category/{id}", [TemplateCategoryController::class, "destroy"])->middleware('auth')->name("TemplateCategory.destroy");
Route::get("/templates/category/{slug}", [TemplateCategoryController::class, "show"])->middleware('auth')->name("TemplateCategory.show");


// Tag Routes
Route::get("/admin/templates/tags", [TemplateTagController::class, "index"])->middleware('auth')->name("TemplateTag.index");
Route::get("/admin/templates/tag/create", [TemplateTagController::class, "create"])->middleware('auth')->name("TemplateTag.create");
Route::post("/admin/templates/tag/create", [TemplateTagController::class, "store"])->middleware('auth')->name("TemplateTag.store");
Route::get("/admin/templates/tag/{slug}/edit", [TemplateTagController::class, "edit"])->middleware('auth')->name("TemplateTag.edit");
Route::put("/admin/templates/tag/{id}", [TemplateTagController::class, "update"])->middleware('auth')->name("TemplateTag.update");
Route::delete("/admin/templates/tag/{id}", [TemplateTagController::class, "destroy"])->middleware('auth')->name("TemplateTag.destroy");
Route::get("/templates/tag/{slug}", [TemplateTagController::class, "show"])->middleware('auth')->name("TemplateTag.show");



Route::get('/templates',[TemplateController::class, 'public_index'])->name('Template.public_index');
Route::get('/templates/search',[TemplateController::class, 'search'])->name('Template.search');
Route::get('/templates/{slug}',[TemplateController::class, 'public_show'])->name('Template.public_show');

Route::get('/admin/templates',[TemplateController::class, 'index'])->middleware('auth')->name('Template.index');
Route::get('/admin/templates/create', [TemplateController::class, 'create'])->middleware('auth')->name('Template.create');
Route::post('/admin/templates/create', [TemplateController::class, 'store'])->middleware('auth')->name('Template.store');
Route::get('/admin/templates/edit/{slug}', [TemplateController::class, 'edit'])->middleware('auth')->name('Template.edit');
Route::put('/admin/templates/edit/{slug}', [TemplateController::class, 'update'])->middleware('auth')->name('Template.update');
Route::get('/admin/templates/{slug}', [TemplateController::class, 'public_show'])->middleware('auth')->name('Template.show');
Route::delete('/admin/templates/delete/{slug}', [TemplateController::class, 'destroy'])->middleware('auth')->name('Template.destroy');


