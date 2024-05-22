<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->error('', 'email or password do not match', 401);
        }

        $user = Auth::user();

        if($user->is_doctor){
            return $this->success([
                'user'=>$user,
                'token'=>$user->createToken('API Token of '. $user->name)->plainTextToken,
                'message'=>'you are doctor'
            ]);
        }
        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('API Token of '. $user->name)->plainTextToken,
            'message'=>'you are not  doctor'
        ]);

    }

}
