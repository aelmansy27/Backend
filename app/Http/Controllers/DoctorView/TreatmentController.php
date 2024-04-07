<?php

namespace App\Http\Controllers\DoctorView;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index(Request $request)
    {
        $treatments = Treatment::all();

        return response([
            'status' => true,
            'treatments' => $treatments,
        ]);
    }

    public function show($id){
        $treatment=Treatment::findOrFail($id);
        return response([
            'status'=>true,
            'treatment'=>$treatment
        ]);
    }
}
