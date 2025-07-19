<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeighingRequest;
use App\Http\Requests\UpdateWeighingRequest;
use App\Models\Weighing;

class WeighingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Weighing::with(['vehicle', 'fieldCrop.field', 'fieldCrop.crop', 'storage'])
                ->orderBy('start_record_at', 'desc')
                ->orderBy('recorded_at', 'desc')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWeighingRequest $request)
    {
        $weighing = Weighing::create($request->validated());

        return response()->json($weighing->load(['vehicle', 'fieldCrop.field', 'fieldCrop.crop', 'storage']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Weighing $weighing)
    {
        return response()->json(
            $weighing->load(['vehicle', 'fieldCrop.field', 'fieldCrop.crop', 'storage'])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeighingRequest $request, Weighing $weighing)
    {
        $weighing->update($request->validated());

        return response()->json(
            $weighing->load(['vehicle', 'fieldCrop.field', 'fieldCrop.crop', 'storage'])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Weighing $weighing)
    {
        $weighing->delete();

        return response()->noContent();
    }
}
