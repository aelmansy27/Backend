<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\FeedStock;
use Illuminate\Http\Request;

class FeedStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedStock = FeedStock::get();
        return response()->json([
            'status' => true,
            'feedStock' => $feedStock ,
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
//        $feedStock = FeedStock::with('cowFeed')->findOrFail($id);
//        return response()->json([
//            'status' => true,
//            '$feedStock' => $feedStock,
//        ]);
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
