<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;

class ActivateController extends Controller
{
    public function store($token)
    {
        if($token){
            $user = User::where('activateToken', $token)->first();

            if($user){
                $user->update(['active' => 1]);
                Auth::login($user);
            }
            return Redirect('login');
        }
    }
}
