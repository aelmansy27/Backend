<?php

namespace App\Http\Controllers\UserView;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use Illuminate\Http\Request;

class CowController extends Controller
{
    public function index()
    {
        $cows = Cow::with('activityPlace')->get();

        return response([
            'status' => true,
            'cows' => $cows,
        ]);
    }

    public function show($id)
    {
        $cow=Cow::findOrFail($id);
        return response([
           'status'=>true,
           $cow
        ]);
    }

    public function search(Request $request)
    {
        $filter=$request->cowId;
        $cow=Cow::query()
            ->where('cowId','LIKE',"%{$filter}%")
            ->get();
        return response([
            'status'=>true,
            $cow
        ]);
    }

}
