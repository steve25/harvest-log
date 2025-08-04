<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WeightController extends Controller
{
    public function update(Request $request)
    {
        Cache::clear('weight');
        Cache::forever('weight', $request->weight_kg);

        return response()->json([
            'weight' => $request->weight_kg
        ]);
    }

    public function show()
    {
        $weight = Cache::get('weight');

        if ($weight === null) {
            return response()->json(['message' => 'No weight available'], 404);
        }

        return response()->json(['weight' => $weight]);
    }
}
