<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request)
    {
        $request->validate([$request->all()]);

        $user=User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'is_doctor'=>$request->is_doctor,
            'image'=>$request->image,
            'phone'=>$request->phone,
        ]);

        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('API Token of '. $user->name)->plainTextToken
        ]);
    }

}
