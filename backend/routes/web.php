<?php

use App\Models\Field;
use App\Models\Vehicle;
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

Route::get('/vehicles', function () {
    return response()->json([
        'vehicles' => Vehicle::all()
    ]);
});
