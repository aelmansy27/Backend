<?php

namespace App\Http\Controllers\UserView;

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
        $filter=$request->cowId;
        $cow=Cow::query()
            ->where('cowId','LIKE',"%{$filter}%")
            ->get();
        return response([
            'status'=>true,
            $cow
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
