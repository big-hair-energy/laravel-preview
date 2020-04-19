<?php

use Illuminate\Support\Facades\Route;

Route::get(config('preview.path'), 'PreviewController@index');
