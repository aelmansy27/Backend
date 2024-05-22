<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    use HttpResponses;
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $input=$request->only('email');
        $user=User::where('email',$input)->first();
        $user->notify(new ResetPasswordNotification());

        return $this->success([
            'message'=>'You have reset your password'
        ]);
    }
}
