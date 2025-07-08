<?php

use App\Models\Field;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fields', function () {
    return response()->json([
        'fields' => Field::all()
    ]);
});
