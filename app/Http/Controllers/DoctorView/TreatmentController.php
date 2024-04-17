<?php

namespace App\Http\Controllers\DoctorView;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use App\Models\Treatment;
use App\Models\TreatmentDoseTimes;
use App\Models\TreatmentStock;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\Translation\t;

class TreatmentController extends Controller
{
    public function index(Cow $cow)
    {
        $retrievedCow = $cow->load('treatments.treatmentDoseTimes');  // Eager load treatments using route model binding

        if (!$retrievedCow) {
            return response()->json(['message' => 'Cow not found'], 404);
        }

        return response()->json([
            'status' => true,
            'treatments' => $retrievedCow->treatments,
        ]);

    }

    public function show(Cow $cow,$id){
        $treatment=Treatment::where('cow_id',$cow->id)->findOrFail($id);

        $treatment->load('treatmentDoseTimes');
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

    public function edit($id,Request $request){
        $validator=Validator::make($request->all(),[
           'name'=>'required|string',
            'search_term'=>'required|string',
            'disease'=>'required|string',
            'doses'=>'integer',
            'diagnose'=>'string|nullable'
        ]);
        if($validator->fails()){
            return response()->json(['message'=>$validator->errors()->first()],400);
        }

        $treatment=Treatment::findOrFail($id);

        $treatment->name=$request->name;
        if($request->has('search_term')){
            $parts=explode(' ',$request->search_term);
            if(!empty($parts)){
                $name=$parts[0];
                $type=isset($parts[1]) ? $parts[1] : null;
                $treatmentStock=TreatmentStock::where('name', $name)
                    ->where('type',$type)
                    ->first();

                if(!$treatmentStock){
                    return response()->json(['message'=>'Treatment not found']);
                }
                $treatment->name=$request->name;
                $treatment->treatmentstock_id=$treatmentStock->id;
            }else{
                return response()->json(['message'=>'Invalid search term']);
            }
        }
        $treatment->disease = $request->disease;

        if (isset($request->doses)) {
            $treatment->doses = $request->doses;
        }

        $treatment->diagnose = $request->diagnose;

        $treatment->save();

        $treatmentData = [
            'id' => $treatment->id,
            'cow_id' => $treatment->cow_id,
            'name' => $treatment->name, // Updated name if search term was used
            'treatmentstock_id'=>$treatment->treatmentstock_id,
            'disease' => $treatment->disease,
            'doses' => $treatment->doses,
            'diagnose' => $treatment->diagnose,
        ];

        return response()->json([
            'message' => 'Treatment updated successfully!',
            'treatment' => $treatmentData,
        ]);


    }
}
