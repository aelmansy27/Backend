<?php

namespace App\Http\Controllers\UserView;

use App\Http\Controllers\Controller;
use App\Models\CowFeed;
use Illuminate\Http\Request;

class CowFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cowFeed = CowFeed::all();
        return response()->json([
            'status' => true,
            '$cowFeed' => $cowFeed,
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
    public function show(string $id)
    {
        $cowFeed = CowFeed::with('users','feedStock','cows','breedingSystems')->findOrFail($id);
        return response()->json([
            'status' => true,
            'cowFeed' => $cowFeed,
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
}
