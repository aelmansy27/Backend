<?php

namespace App\Http\Controllers\UserView;

use App\Http\Controllers\Controller;
use App\Models\BreadingSystem;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BreedingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $breadingSystems = BreadingSystem::all();


        return response()->json([
            'status' => true,
            'breadingSystems' => $breadingSystems,
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


        $system = BreadingSystem::where('name', 'LIKE', "%{$filter}%")// Eager loading (optional)
        ->first();


        if (!$system) {
            return response([
                'status' => false,
                'message' => 'Breeding System not found'
            ], 404);
        }

        $cow = $system->cows; // Assuming activityPlace is the relationship

        if (!$cow) {
            return response([
                'status' => false,
                'message' => 'cows not found for this breeding system'
            ], 404);
        }
        return response([
            'status' => true,
            'breadingSystem' => $system,
            'cows' => $cow->count()
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
