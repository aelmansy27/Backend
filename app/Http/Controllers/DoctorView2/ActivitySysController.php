<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\ActivitySystem;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivitySysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activitySystems = ActivitySystem::with('breadingSystem')->get();
        $numberOfCows = ActivitySystem::distinct('cow_id')->count('cow_id');


        return response()->json([
            'status' => true,
            'activitySystems' => $activitySystems,
            'number_of_cows' => $numberOfCows,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'goal' => 'required',
            'cause_of_creation' => 'required',
            'description' => 'required',
            'activities' => 'required',
            'cows' => 'required|array', // Validate that cows input is an array
            'cows.*' => 'exists:cows,cowId',
            // Validate that each cow ID exists in the cows table
           // 'num_cows_applied' => 'required|integer|min:1',
          //  'apply_duration' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()], 400);
        } else {

            // Assuming 'cows' is returned from the 'cow' table, you may need to adjust this part based on your database structure
            $num_cows_applied = Cow::count();

            $activitySystem = ActivitySystem::create([
                'name' => $request->name,
                'goal' => $request->goals,
                'cause_of_creation' => $request->cause_of_creation,
                'description' => $request->description,
                'activities' => $request->activities,
               // 'apply_duration' => $request->apply_duration,

             //  'num_cows_applied' => 'required|integer|min:1',
            ]);

            //$cows = Cow::inRandomOrder()->take($request->num_cows_selected)->get();
            foreach ($request->cows as $cowId) {
                $cow = Cow::findOrFail($cowId);
                $cow->activitySystem()->associate($activitySystem);
                $cow->save();
            }
            if ($activitySystem) {


                return response()->json(['status' => 200, 'message' => "Activity System created successfully"], 200);
            } else {
                return response()->json(['status' => 500, 'message' => "Something went wrong!"], 500);
            }
        }
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
        $numberOfCows = ActivitySystem::distinct('cow_id')->count('cow_id');

        return response()->json([
            'status' => true,
            $activitySystems,
            'number_of_cows' => $numberOfCows,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activitySystems = ActivitySystem::with('breadingSystem')->findOrFail($id);
        return response()->json([
            'status' => true,
            $activitySystems,]);

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

        // Retrieve the activity system by ID
        $activitySystem = ActivitySystem::find($id);

        if (!$activitySystem) {
            return response()->json(['status' => 404, 'message' => 'Activity System not found'], 404);
        }

        // Update the activity system with new data
        $activitySystem->name = $request->name;
        $activitySystem->goal = $request->goal;
        $activitySystem->cause_of_creation = $request->cause_of_creation;
        $activitySystem->description = $request->description;
        $activitySystem->activities = $request->activities;

        // Calculate apply duration
//        $sleepTime = Carbon::parse($request->sleep_time);
//        $wakeUpTime = Carbon::parse($request->wake_up_time);
//        $applyDurationMinutes = $wakeUpTime->diffInMinutes($sleepTime);
//        $activitySystem->apply_duration = $applyDurationMinutes;

        // Save the updated activity system
        $activitySystem->save();

        return response()->json(['status' => 200, 'message' => 'Activity System updated successfully'], 200);
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
        ->get();
        // Assuming $request->type holds a valid enum value (e.g., 'warehouse1')
        //$place = ActivityPlace::with('cows')->where('type', $filter)->first();

        if (!$system) {
            return response([
                'status' => false,
                'message' => 'Activity system not found'
            ], 404);
        }

        $cow = $system->cows; // Assuming activitySystem is the relationship

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

    public function searchWithFilter(Request $request){
        $validator=Validator::make($request->all(),[
            'type'=>'required|string',
            'cowId'=>'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $type = $request->get('type');
        $cowId=$request->get('cowId');

        $activitySystem = ActivitySystem::where('type', $type)->get();

        if($cowId !== null){
            $activitySystem->load(['cows' => function ($query) use ($cowId) {
                $query->where('cowId', 'LIKE', "%{$cowId}%");
            }]);        }
        return response()->json($activitySystem);
        }

}
