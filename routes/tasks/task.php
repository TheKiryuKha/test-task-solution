<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', 'index')->name('index');
Route::post('/', 'store')->name('store');

Route::put('/{task}', 'update')->name('update');
Route::delete('/{task}', 'destroy')->name('destroy');
