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

Route::get('/fields/{id}/crops', function ($id) {
    return response()->json([
        'crops' => Field::with('crops')->findOrFail($id)->crops
    ]);
});
