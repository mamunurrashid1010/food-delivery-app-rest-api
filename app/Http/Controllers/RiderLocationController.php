<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RiderLocation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RiderLocationController extends Controller
{
    /**
     * store rider location
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // data validation
        $data = $request->validate([
            'rider_id' => 'required|exists:riders,id',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'capture_time' => 'required|date',
        ], [
            'rider_id.required' => 'The rider_id field is required.',
            'rider_id.exists' => 'The selected rider_id is invalid.',
            'lat.required' => 'The lat field is required.',
            'lat.numeric' => 'The lat field must be a number.',
            'long.required' => 'The long field is required.',
            'long.numeric' => 'The long field must be a number.',
            'capture_time.required' => 'The capture_time field is required.',
            'capture_time.date' => 'The capture_time field must be a valid date.',
        ]);

        // store data
        RiderLocation::query()->create($data);

        return response()->json([
            'status' => true,
            'message' => 'Location stored successfully'
        ]);
    }

    /**
     * nearestRider
     * @param Request $request
     * @return JsonResponse
     */
    public function nearestRider(Request $request): JsonResponse
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        $restaurantId = $request->input('restaurant_id');

        $nearestRider = RiderLocation::nearestRiderToRestaurant($restaurantId);

        return response()->json([
            'status' => true,
            'rider' => $nearestRider
        ]);
    }

}
