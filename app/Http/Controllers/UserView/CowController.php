<?php

namespace App\Http\Controllers\UserView;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use Illuminate\Http\Request;

class CowController extends Controller
{
    public function index()
    {
        $cows=Cow::paginate(10);
        return response([
            'status'=>true,
            $cows
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
        $filter=$request->cow_id;
        $cow=Cow::query()
            ->where('cow_id','LIKE',"%{$filter}%")
            ->get();
        return response([
            'status'=>true,
            $cow
        ]);
    }

}
