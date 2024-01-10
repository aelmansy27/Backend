<?php

namespace App\Http\Controllers\UserView;

use App\Http\Controllers\Controller;
use App\Models\ActivityPlace;
use Illuminate\Http\Request;

class ActivityPlaceController extends Controller
{
    public function index()
    {
        $activityPlaces = ActivityPlace::with('cows')->withCount('cows')->get();

        return response([
            'status' => true,
            'activityPlaces' => $activityPlaces,
        ]);
    }

    public function show($id)
    {
        $activityplace=ActivityPlace::findOrFail($id);
        return response([
           'status'=>true,
           $activityplace
        ]);
    }

}
