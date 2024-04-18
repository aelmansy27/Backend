<?php

namespace App\Http\Controllers\DoctorView;


use App\Enums\ActivityType;
use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureUserIsDoctor;
use App\Models\ActivityPlace;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;


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
        $activityplace = ActivityPlace
            ::with('cows')
            ->withCount('cows')
            ->findOrFail($id);

        return response([
            'status' => true,
            $activityplace
        ]);
    }

    public function searchPlace(Request $request)
    {

        $filter = $request->type; // Assuming $request is available in your controller method


        $place = ActivityPlace::where('type', 'LIKE', "%{$filter}%")// Eager loading (optional)
        ->first();

        // Assuming $request->type holds a valid enum value (e.g., 'warehouse1')
        //$place = ActivityPlace::with('cows')->where('type', $filter)->first();

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
            'activityPlace' => $place,
            'cows' => $cow->count()
        ]);

    }

    public function filterByCowStatus(Request $request,ActivityPlace $activityPlace){
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $status = $request->get('status');


        $cows = Cow::where('activityplace_id',$activityPlace->id)
            ->where('cow_status', $status)
            ->get() ;
        return response()->json($cows, 200);

    }


}
