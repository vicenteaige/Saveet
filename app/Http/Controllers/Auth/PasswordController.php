<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\Http\Requests;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function apiResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                [
                    'header' => [
                        'success' => 'no',
                        'msg' => 'El formato del email no es correcto'
                    ]
                ]
            ]);
        }
    //comprobar si el email es de un usuario registrado
        $resetsPasswords = new PasswordController();
        $resetsPasswords->postEmail($request);
    //comprobar si el email se envia bien, y hacer que aparezca un mensaje tipo "El email se ha enviado", o de error en caso contrario
    }
}
