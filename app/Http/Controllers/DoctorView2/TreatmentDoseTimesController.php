<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use App\Models\Treatment;
use App\Models\TreatmentDoseTimes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TreatmentDoseTimesController extends Controller
{
    public function createDoseTime(Request $request,Treatment $treatment){
            $validator=Validator::make($request->all(),[
                'dose_times'=>'required|array',
                'dose_times.*.date'=>'required|date',
                'dose_times.*.time'=>'required|date_format:H:i:s',
                'dose_times.*.is_Taken'=>'nullable|boolean'
            ]);

            TreatmentDoseTimes::unguard();
            $doseTimesData=$request->get('dose_times');
            $createdDoseTimes=$treatment->treatmentDoseTimes()->createMany($doseTimesData);

            TreatmentDoseTimes::reguard();
            return response()->json([
                'message'=>'Treatment dose times created successfully',
                'created_dose_times'=>$createdDoseTimes
            ]);
    }


    public function editDoseTime(Request $request,Treatment $treatment){
        $validator=Validator::make($request->all(),[
            'dose_times'=>'required|array',
            'dose_times.*.date'=>'required|date',
            'dose_times.*.time'=>'required|date_format:H:i:s',
            'dose_times.*.is_Taken'=>'nullable|boolean'
        ]);

        $existingDoseTimes=$treatment->treatmentDoseTimes;
        $doseTimesData=$request->get('dose_times');

        if ($existingDoseTimes->count() > 0) {
            $doseTimesData = array_merge($existingDoseTimes->toArray(), $doseTimesData);
        }
        TreatmentDoseTimes::unguard();
        $doseTimesData=$request->get('dose_times');
        $createdDoseTimes=$treatment->treatmentDoseTimes()->createMany($doseTimesData);

        TreatmentDoseTimes::reguard();
        return response()->json([
            'message'=>'Treatment dose times updated successfully',
            'created_dose_times'=>$createdDoseTimes
        ]);
    }
}
