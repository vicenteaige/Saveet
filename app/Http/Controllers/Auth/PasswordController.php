<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\User;
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
    
        //comprovar si l'email es d'un usuari registrat

        $resetsPasswords = new PasswordController();
        $resetsPasswords->postEmail($request);
        
        //comprobar si el email se envia bien, y hacer que aparezca un mensaje tipo "El email se ha enviado", o de error en caso contrario
    }

    public function apiChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'  =>'required|string',
            'password_confirmation' => 'required|string|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                [
                    'header' => [
                        'success' => 'no',
                        'msg' => 'Los passwords no son iguales, o algun formato es incorrecto'
                    ]
                ]
            ]);
        }

        $user =  User::where('email', $request->email);
        $user -> password = bcrypt($request->password);
        $user -> save();
        
        //cambiar la contraseña del usuario
    }
}
