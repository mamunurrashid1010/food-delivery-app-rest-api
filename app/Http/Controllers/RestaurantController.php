<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * index
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $restaurants = Restaurant::all();
        return response()->json([
            'status' => true,
            'restaurants' => $restaurants
        ]);
    }

    /**
     * show
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $restaurant = Restaurant::query()->findOrFail($id);
        return response()->json([
            'status' => true,
            'restaurant' => $restaurant
        ]);
    }

    /**
     * store
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        $restaurant = Restaurant::query()->create($data);

        return response()->json([
            'status' => true,
            'message' => 'Restaurant created successfully',
            'restaurant' => $restaurant
        ]);
    }

}
