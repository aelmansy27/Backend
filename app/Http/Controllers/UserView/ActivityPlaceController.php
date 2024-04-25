<?php

namespace App\Http\Controllers\UserView;


use App\Http\Controllers\Controller;
use App\Models\ActivityPlace;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;


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
        $filter = $request->type; // Assuming $request is available in your controller method
        $query= ActivityPlace::with('cows');// Eager loading (optional)

        // Assuming $request->type holds a valid enum value (e.g., 'warehouse1')
        $place = $query->where('type', 'LIKE','%'.$filter.'%')->get();

        if (!$place) {

            return response([
                'status' => false,
                'message' => 'Activity place not found'
            ], 404);
        }

        // Assuming activityPlace is the relationship

        /*if (!$cow) {
            return response([
                'status' => false,
                'message' => 'cows not found for this activity place'
            ], 404);
        }*/
        return response([
            'status' => true,
            'activity places' => $place,

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


        $cows = Cow::where('activity_place_id',$activityPlace->id)
            ->where('cow_status', $status)
            ->get();
        return response()->json($cows, 200);

    }

    public function filterByType(Request $request){
        $validator=Validator::make($request->all(),[
            'type'=>'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $type = $request->get('type');

        $activityPlaces = ActivityPlace::where('type', $type)->get();

        return response()->json($activityPlaces);
    }


}
