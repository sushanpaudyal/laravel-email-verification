<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ActivationController extends Controller
{
    public function activate(Request $request){
        $user = User::byActivationColumns($request->email, $request->token)->firstOrFail();
        $user->update([
            'active' => true,
            'activation_token' => null
        ]);
        Auth::loginUsingId($user->id);
        return redirect()->route('home')->withSuccess('Activated ! you are now signed in');

    }
}

