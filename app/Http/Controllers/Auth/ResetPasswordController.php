<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Traits\HttpResponses;

use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use HttpResponses;
    private $otp;
    public function __construct()
    {
        $this->otp=new Otp();
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $otp2=$this->otp->validate($request->email,$request->otp);
        if(!$otp2->status){
            return $this->error('',$otp2,401);
        }
        $user=User::where('email',$request->email)->first();
        $user->update(['password'=>Hash::make($request->password)]);
        $user->tokens()->delete();
        return $this->success([
            'message'=>'you have resst your password successfully!'
        ]);
    }
}
