<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;

class ResetPasswordWithPhoneController extends Controller
{
    public function forgetPassword(Request $request)
    {

        $user = User::where('phone', $request->input('phone'))->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $verificationCode = mt_rand(100000, 999999);

        // Send verification code via Twilio
        $twilio = new Twilio(
            getenv('TWILIO_SID'),
            getenv('TWILIO_AUTH_TOKEN'),
            getenv('TWILIO_PHONE_NUMBER')
        );
        $twilio->message($user->phone, "Your verification code is: $verificationCode");

        return response()->json(['message' => 'Verification code sent']);
    }

    public function ResetPassword(Request $request)
    {
        $phoneNumber = $request->input('phone');
        $verificationCode = $request->input('verification_code');
        $newPassword = $request->input('password');

        $user = User::where('phone', $request->input('phone'))->first();

        if (!$user || $verificationCode != $request->input('verification_code')) {
            return response()->json(['message' => 'Invalid verification code'], 400);
        }

        // Reset password
        $user->password = Hash::make($request->input('password'));
        $verificationCode = null;
        $user->save();

        return response()->json(['message' => 'Password reset successfully']);
    }

}
