<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request)
    {
        $request->validate([$request->all()]);

        $user=User::create([
            'name'=>$request->name,
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

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = Auth::user();

        return $this->success([
           'user'=>$user,
           'token'=>$user->createToken('API Token of '. $user->name)->plainTextToken
        ]);
    }
}
