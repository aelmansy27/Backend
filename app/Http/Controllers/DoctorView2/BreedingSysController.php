<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\BreadingSystem;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BreedingSysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadingSystems = BreadingSystem::with([
            'cows' => function ($query) {
                $query->with('breadingSystem', 'activityPlace', 'activitySystem'); // Include related models
            },
            'cows.breadingSystem', // Include breedingSystem directly (optional)
            'cows.activitySystem',
            'cows.activityPlace'// Include readingSystem directly (optional)
        ])->withCount('cows')->get();

        return response()->json([
            'status' => true,
            'breadingSystems' => $breadingSystems,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'purpose' => 'required',
            'goal' => 'required',
            'CauseOfCreation' => 'required',
            'description' => 'required',
            'duration' => 'required',
            // Add validation rules for other fields as needed
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()], 400);
        } else {
            $breadingSystems = BreadingSystem::create([
                'name' => $request->name,
                // 'purpose' => $request->purpose,
                'goal' => $request->goal,
                'CauseOfCreation' => $request->CauseOfCreation,
                //'description' => $request->description,
                //'duration' => $request->duration,
            ]);
        }

        if ($breadingSystems) {
            return response()->json([
                'status' => 200, 'message' => "Breeding System created successfully"], 200);
        } else {
            return response()->json([
                'status' => 500, 'message' => "Something went wrong!"], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $breadingSystems = BreadingSystem::findOrFail($id);
        return response()->json([
            'status' => true,
            $breadingSystems,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breedingSystems = BreadingSystem::findOrFail($id);
        return response()->json([
            'status' => true,
            $breedingSystems,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'goal' => 'required',
            'cause_of_creation' => 'required',
            'description' => 'required',
            'activities' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()], 400);
        }


        $breedingSystem = BreadingSystem::find($id);

        if (!$breedingSystem) {
            return response()->json(['status' => 404, 'message' => 'Activity System not found'], 404);
        }


        $breedingSystem->name = $request->name;
        $breedingSystem->goal = $request->goal;
        $breedingSystem->cause_of_creation = $request->cause_of_creation;
        $breedingSystem->description = $request->description;
        $breedingSystem->activities = $request->activities;

        // Calculate apply duration
//        $sleepTime = Carbon::parse($request->sleep_time);
//        $wakeUpTime = Carbon::parse($request->wake_up_time);
//        $applyDurationMinutes = $wakeUpTime->diffInMinutes($sleepTime);
//        $activitySystem->apply_duration = $applyDurationMinutes;

        // Save the updated activity system
        $breedingSystem->save();

        return response()->json(['status' => 200, 'message' => 'Breeding System updated successfully'], 200);
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


        $system = BreadingSystem::where('name', 'LIKE', "%{$filter}%")// Eager loading (optional)
        ->get();


        if (!$system) {
            return response([
                'status' => false,
                'message' => 'Breeding System not found'
            ], 404);
        }

      //  $cow = $system->cows; // Assuming activityPlace is the relationship

//        if (!$cow) {
//            return response([
//                'status' => false,
//                'message' => 'cows not found for this breeding system'
//            ], 404);
       // }
        return response([
            'status' => true,
            'breadingSystem' => $system,
            //'cows' => $cow->count()
        ]);

    }
    public function filterByCowStatus(Request $request,BreadingSystem $breadingSystem)

    {
        $validator= Validator::make($request->all(),
            [
                'status'=>'required|boolean',
            ]);

        if($validator->fails()){
            return response ()->json($validator->errors(),400);
        }
        //$breadingSystems = BreadingSystem::with('cows')->get();

        $status = $request->get('status');

        $cows= Cow::where('breadingsystem_id', $breadingSystem->id)
            ->where('cow_status', $status)
            ->get();
//        $cows = $breadingSystem->cows()
//            ->where('cow_status', $status)
//            ->get();
        return response ()->json($cows,200);
    }
}
