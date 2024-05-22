<?php

namespace App\Http\Controllers\DoctorView1;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PregnancyController extends Controller
{
   public function pregnantCow(Request $request,Cow $cow){

       $validator=Validator::make($request->all(),[
          'is_active'=>'boolean'
       ]);
       if ($validator->fails()) {
           return response()->json($validator->errors(), 400);
       }

       $is_active=$request->get('is_active');
       if($is_active){
           $cow->is_pregnant=1;
       }
       return response()->json([
           'cow'=>$cow,
           'message'=>'cow is pregnant now',
       ],200);
   }

    public function notPregnant(Request $request,Cow $cow){

        $validator=Validator::make($request->all(),[
            'is_pregnant'=>'boolean'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $is_pregnant=$request->get('is_pregnant');
        if(!$is_pregnant){
            $cow->is_pregnant=0;
        }
        return response()->json([
            'cow'=>$cow,
            'message'=>'cow is born now',
        ],200);
    }
}

