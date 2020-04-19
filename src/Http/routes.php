<?php

use Illuminate\Support\Facades\Route;

Route::get(config('preview.path'), 'PreviewController@index')->name('bhe.preview');
Route::post(config('preview.path'), 'PreviewController@authenticate');
