<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class RiderLocation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates =['deleted_at'];

    protected $fillable = ['rider_id','lat','long','capture_time'];

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Riders::class, 'rider_id');
    }

    public static function nearestRiderToRestaurant($restaurantId)
    {
        $nearestRider = self::nearestToRestaurant($restaurantId)
            ->where('capture_time', '>=', now()->subMinutes(5))
            ->first();

        return $nearestRider;
    }

    public static function nearestToRestaurant($restaurantId)
    {
        $restaurant = Restaurant::query()->findOrFail($restaurantId);

        return self::select('*')
            ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(long) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance', [$restaurant->lat, $restaurant->long, $restaurant->lat])
            ->whereHas('rider', function ($subQuery) use ($restaurantId) {
                $subQuery->where('restaurant_id', $restaurantId);
            })
            ->orderBy('distance', 'asc');
    }
}
