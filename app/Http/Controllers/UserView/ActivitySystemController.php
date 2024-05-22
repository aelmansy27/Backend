<?php

namespace App\Http\Controllers\UserView;

use App\Http\Controllers\Controller;
use App\Models\ActivitySystem;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivitySystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activitySystems = ActivitySystem::with('breadingSystem')->get();

        return response()->json([
            'status' => true,
            'activitySystems' => $activitySystems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $activitySystems = ActivitySystem::with('breadingSystem')->findOrFail($id);
        return response()->json([
            'status' => true,
            $activitySystems,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function search(Request $request)
    {

        $filter = $request->name; // Assuming $request is available in your controller method


        $system = ActivitySystem::where('name', 'LIKE', "%{$filter}%")// Eager loading (optional)
        ->first();
        // Assuming $request->type holds a valid enum value (e.g., 'warehouse1')
        //$place = ActivityPlace::with('cows')->where('type', $filter)->first();

        if (!$system) {
            return response([
                'status' => false,
                'message' => 'Activity system not found'
            ], 404);
        }

        $cow = $system->cows; // Assuming activityPlace is the relationship

        if (!$cow) {
            return response([
                'status' => false,
                'message' => 'cows not found for this activity system'
            ], 404);
        }
        return response([
            'status' => true,
            'activitySystem' => $system,
            'cows' => $cow->count()
        ]);

    }
    public function filterByCowStatus(Request $request,ActivitySystem $activitySystem)

    {
        $validator= Validator::make($request->all(),
        [
        'status'=>'required|boolean',
    ]);

    if($validator->fails()){
        return response ()->json($validator->errors(),400);
    }

    $status = $request->get('status');

    $cows= Cow::where('activitysystem_id', $activitySystem->id)
        ->where('cow_status', $status)
        ->get();
    return response ()->json($cows,200);
    }








}
