<?php

namespace App\Http\Controllers\DoctorView;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use App\Models\Treatment;
use App\Models\TreatmentStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request,Cow $cow){
        $this->validate($request,[
            'name'=>'required|string',
            'search_term'=>'required|string',
            'disease'=>'required|string',
            'doses'=>'integer',
            'diagnose'=>'string|nullable'
        ]);

        $parts=explode(' ',$request->search_term);

        if (empty($parts)) {
            return response()->json(['message' => 'Invalid search term (empty)']);
        }

        $name = $parts[0];
        $type = isset($parts[1]) ? $parts[1] : null;

        $treatmentStock=TreatmentStock::where('name', $name)
            ->where('type',$type)
            ->first();

        if(!$treatmentStock){
            return response()->json(['message'=>'Treatment not found']);
        }

        $treatment=new Treatment;

        $treatment->cow_id=$cow->id;

        $treatment->name=$request->name;
        $treatment->treatmentstock_id=$treatmentStock->id;
        $treatment->disease=$request->disease;

        if(isset($request->doses)){
            $treatment->doses=$request->doses;
        }else{
            $treatment->doses=1;
        }

        $treatment->diagnose=$request->diagnose;

        $treatment->save();

        return response()->json([
            'message' => 'Treatment created successfully!',
            'treatment' => [
                'id' => $treatment->id,
                'cow_id' => $treatment->cow_id,
                'name' => $treatment->name,
                'disease' => $treatment->disease,
                'doses' => $treatment->doses,
                'diagnose' => $treatment->diagnose,
            ],
        ], 201);
    }
}
