<?php

use App\Http\Requests\StoreWeighingRequest;
use App\Models\Field;
use App\Models\Vehicle;
use App\Models\Weighing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
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

Route::post('/weighings', function (StoreWeighingRequest $request) {
    $validated = $request->validated();

    $weighing = Weighing::create([
        'vehicle_id' => $validated['vehicle_id'],
        'field_crop_id' => $validated['field_crop_id'],
        'brutto_kg' => $validated['brutto_kg'],
        'netto_kg' => $validated['netto_kg'],
        'tara_kg' => $validated['tara_kg'],
        'recorded_at' => $validated['recorded_at'],
    ]);

    return response()->json([
        'weighing' => $weighing
    ]);
});

Route::get('/weighings', function () {
    return response()->json([
        'weighings' => Weighing::with(['vehicle', 'fieldCrop'])->get()
    ]);
});
