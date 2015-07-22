<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class ActivateController extends Controller
{
    public function store($token)
    {
        $user = User::where('activateToken', '=', $token);

        if(!$user){
            return response()->api(400, 'no', 'No hay usuario', '');
        }

        $user->update(['active' => 1]);

        return response()->api(200, 'yes', '', '');

    }
}
