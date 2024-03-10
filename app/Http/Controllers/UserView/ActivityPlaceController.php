<?php

namespace App\Http\Controllers\UserView;


use App\Http\Controllers\Controller;
use App\Models\ActivityPlace;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ActivityPlaceController extends Controller
{
    public function index()
    {
        $activityPlaces = ActivityPlace
            ::with('cows')
            ->withCount('cows')
            ->get();

        return response([
            'status' => true,
            'activityPlaces' => $activityPlaces,
        ]);
    }

    public function show($id)
    {
        $activityplace=ActivityPlace
            ::with('cows')
            ->withCount('cows')
            ->findOrFail($id);

        return response([
           'status'=>true,
           $activityplace
        ]);
    }

    public function searchPlace(Request $request)
    {
        $filter= $request->type;

        // Assuming there's a relationship between Cow and ActivityPlace
        $place = ActivityPlace::where('type','LIKE',"%{$filter}%")->first(); // Assuming cowId is unique
        if (!$place) {
            return response([
                'status' => false,
                'message' => 'Activity place not found'
            ], 404);
        }

        $cow = $place->cows; // Assuming activityPlace is the relationship

        if (!$cow) {
            return response([
                'status' => false,
                'message' => 'cows not found for this activity place'
            ], 404);
        }

        return response([
            'status' => true,
            'activityPlace' => $cow
        ]);
    }


}
