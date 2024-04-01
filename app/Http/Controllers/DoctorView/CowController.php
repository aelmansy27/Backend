<?php

namespace App\Http\Controllers\DoctorView;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use Illuminate\Http\Request;

use Stevebauman\Location\Facades\Location;

class CowController extends Controller
{
    public function index(Request $request)
    {
        $cows = Cow::with('activityPlace')->get();

        return response([
            'status' => true,
            'cows' => $cows,
        ]);
    }

    public function show($id)
    {
        $cow=Cow::with('activityPlace')->findOrFail($id);
        return response([
           'status'=>true,
           $cow
        ]);
    }

    public function search(Request $request)
    {
        $filter = $request->cowId;

        // Assuming there's a relationship between Cow and ActivityPlace
        $cow = Cow::where('cowId', 'LIKE',"%{$filter}%")->first(); // Assuming cowId is unique
        if (!$cow) {
            return response([
                'status' => false,
                'message' => 'Cow not found'
            ], 404);
        }

        $activityPlaces = $cow->activityPlace; // Assuming activityPlace is the relationship

        if (!$activityPlaces) {
            return response([
                'status' => false,
                'message' => 'Activity place not found for this cow'
            ], 404);
        }

        return response([
            'status' => true,
            'cow'=>$cow,
        ]);
    }

    public function updateLocation(Request $request,$id)
    {
        $cow = Cow::findOrFail($id);

        $ip = $request->ip();
        $location = Location::get($ip);

        if ($location) {
            $cow->update([
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
            ]);
        }

        return response([
            'status' => true,
            'message' => 'Cow location updated successfully',
            'cow' => $cow,
        ]);
    }

}
