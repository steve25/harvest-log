<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\WeighingController;
use App\Http\Controllers\WeightController;
use App\Models\Crop;
use App\Models\Field;
use App\Models\FieldCrop;
use App\Models\Storage;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
});

Route::resource('/weighings', WeighingController::class);


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

Route::get('/crops', function () {
    return response()->json([
        'crops' => Crop::all()
    ]);
});

Route::get('/vehicles', function () {
    return response()->json([
        'vehicles' => Vehicle::all()
    ]);
});

Route::get('/storages', function () {
    return response()->json([
        'storages' => Storage::all()
    ]);
});

Route::get('/field-crops', function () {
    return response()->json([
        'field_crops' => FieldCrop::with(['field', 'crop'])->get()
    ]);
});

Route::put('/weight', [WeightController::class, 'update'])->middleware('auth:sanctum');
Route::get('/weight', [WeightController::class, 'show']);
