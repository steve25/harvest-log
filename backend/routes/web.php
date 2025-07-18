<?php

use App\Http\Controllers\WeighingController;
use App\Http\Requests\StoreWeighingRequest;
use App\Models\Crop;
use App\Models\Field;
use App\Models\FieldCrop;
use App\Models\Storage;
use App\Models\Vehicle;
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

// Route::post('/weighings', function (StoreWeighingRequest $request) {
//     $weighing = Weighing::create($request->validated());

//     return response()->json([
//         'weighing' => $weighing
//     ]);
// });

// Route::get('/weighings', function () {
//     return response()->json([
//         'weighings' => Weighing::with(['vehicle', 'fieldCrop.field', 'fieldCrop.crop', 'storage'])
//             ->orderBy('start_record_at', 'desc')
//             ->orderBy('recorded_at', 'desc')
//             ->get()
//     ]);
// });


Route::resource('/weighings', WeighingController::class);
