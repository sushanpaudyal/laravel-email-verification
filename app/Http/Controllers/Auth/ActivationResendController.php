<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserActivationEmail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationResendController extends Controller
{
    public function showResendForm(){
        return view ('auth.activate.resend');
    }

    public function resend(Request $request){
        $this->validateResendRequest($request);
        $user = User::where('email', $request->email)->first();
        event(new UserActivationEmail($user));
        return redirect()->route('login')->withSuccess('Email Activation has been resent successfully');
    }

    protected function validateResendRequest(Request $request){
        $this->validate($request,[
             'email' => 'required| email|exists:users,email'
        ],[
            'email.exists' => 'This email is not exists. Please check your email'
            ]);
    }
}
