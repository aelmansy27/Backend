<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;

class CowController extends Controller
{
    public function index()
    {
        $cows = Cow::with('activityPlace', 'activitySystem', 'breadingSystem')->get();

        return response([
            'status' => true,
            'cows' => $cows,
        ]);

    }

    public function show($id)
    {
        $cow = Cow::with('activityPlace', 'activitySystem', 'breadingSystem')->findOrFail($id);

        return response([
            'status' => true,
            $cow
        ]);
    }

    public function search(Request $request)
    {

        $filter = $request->cowId;

        // Assuming there's a relationship between Cow and ActivityPlace
        $cow = Cow::where('cowId', 'LIKE', "%{$filter}%")
                ->get(); // Assuming cowId is unique
        if (!$cow) {
            return response([
                'status' => false,
                'message' => 'Cow not found'
            ], 404);
        }

        //$activityPlaces = $cow->activityPlace; // Assuming activityPlace is the relationship

        /*if (!$activityPlaces) {
            return response([
                'status' => false,
                'message' => 'Activity place not found for this cow'
            ], 404);
        }*/

        return response([
            'status' => true,
            'cow' => $cow,
        ], 200);
    }

    public function updateLocation(Request $request, $id)
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


    public function filterCowByAge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_range' => 'required|numeric',
            'max_range' => 'required|numeric'
        ]);
        //dd($validator);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $minRange = $request->get('min_range');
        $maxRange = $request->get('max_range');

        $query = Cow::whereNotNull('birthday_date');
        if (isset($minRange) && isset($maxRange)) {
            // Handle specific age ranges based on your requirements
            if ($minRange == 0 && $maxRange == 0.3) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [0]) // 0 days
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [3]); // Up to 3 days
            } else if ($minRange == 0.3 && $maxRange == 3) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [4]) // More than 3 days (1 month)
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [90]); // Up to 3 months
            } else if ($minRange == 3 && $maxRange == 12) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [91]) // More than 3 months (4 months)
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [365]); // Up to 1 year (12 months)
            } else if ($minRange == 1 && $maxRange == 3) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [365]) // More than 1 year
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [1095]); // Up to 3 years
            } else if ($minRange == 3 && $maxRange == 6) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [1096]) // More than 3 years
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [2190]); // Up to 6 years
            } else {
                return response()->json(['message' => 'Invalid age range'], 400);
            }
        } else {
            return response()->json(['message' => 'Please provide both min_range and max_range parameters'], 400);
        }

        $calves = $query->get();

        return response()->json($calves);
    }

    public function filterCowByStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $status = $request->get('status');


        $cows = Cow::where('cow_status', $status)
            ->get();

        return response()->json($cows, 200);
    }

    public function filterCowByStatusWithSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean',
            'cowId' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $status = $request->get('status');
        $cowId = $request->get('cowId');

        $cows = Cow::where('cow_status', $status);

        if ($cowId !== null) {
            $cows->where('cowId', 'LIKE', "%{$cowId}%");
        }
        $query = $cows->get();

        return response()->json($query, 200);
    }

    public function filterCowByAgeWithSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_range' => 'required|numeric',
            'max_range' => 'required|numeric',
            'cowId' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $minRange = $request->get('min_range');
        $maxRange = $request->get('max_range');

        $query = Cow::whereNotNull('birthday_date');
        if (isset($minRange) && isset($maxRange)) {
            // Handle specific age ranges based on your requirements
            if ($minRange == 0 && $maxRange == 0.3) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [0]) // 0 days
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [3]); // Up to 3 days
            } else if ($minRange == 0.3 && $maxRange == 3) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [4]) // More than 3 days (1 month)
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [90]); // Up to 3 months
            } else if ($minRange == 3 && $maxRange == 12) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [91]) // More than 3 months (4 months)
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [365]); // Up to 1 year (12 months)
            } else if ($minRange == 1 && $maxRange == 3) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [365]) // More than 1 year
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [1095]); // Up to 3 years
            } else if ($minRange == 3 && $maxRange == 6) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [1095]) // More than 3 years
                ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [2190]); // Up to 6 years
            } else if ($minRange > 6 && $maxRange > $minRange) {
                $query->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) >= ?'), [2190])
                    ->whereRaw(DB::raw('DATEDIFF(CURDATE(), birthday_date) <= ?'), [4380]);
            } else {
                return response()->json(['message' => 'Invalid age range'], 400);
            }
        } else {
            return response()->json(['message' => 'Please provide both min_range and max_range parameters'], 400);
        }
        $cowId = $request->get('cowId');
        $calves = $query->get();


        if ($cowId !== null) {
            $calves->where('cowId', 'LIKE', "%{$cowId}%");
        }
        //$query=$calves->get();

        return response()->json($calves, 200);
    }
}
