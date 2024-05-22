<?php

namespace App\Http\Controllers\DoctorView1;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditUserDataController extends Controller
{
    public function edit(Request $request){
        //->update($request->all());
        $user=User::findOrFail($request->id);
        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'image'=>$request->image,
            'phone'=>$request->phone,
        ]);
        $user->save();

        return response()->json([
            'success'=>true,
            'message'=>'user data update successfully'
        ]);

    }
}
