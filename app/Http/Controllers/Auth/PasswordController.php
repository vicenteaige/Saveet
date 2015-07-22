<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\User;
use App\Http\Requests;
use Log;
use DB;

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
            'email'      => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->api(400, 'no', 'Email does not exist, or has incorrect format','');
        }
    
        //comprovar si l'email es d'un usuari registrat

        $resetsPasswords = new PasswordController();
        $resetsPasswords->postEmail($request);
        
        //comprobar si el email se envia bien, y hacer que aparezca un mensaje tipo "El email se ha enviado", o de error en caso contrario
    }

    public function store(Request $request) 
    {
        //Log::debug('Entro a la funcio apiChangePassword');
        $validator = Validator::make($request->all(), [
            //'email' => 'required|email|exists:users,email',
            'password'  =>'required|string|confirmed',
            'password_confirmation' => 'required|string',
            'token'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->api(400, 'no', 'Passwords are not the same, email does not exist, or incorrect format', '');
        }

        $userEmail = DB::table('password_resets')->where('token', '=', $request->token)->value('email');


        $user = User::where('email', '=', $userEmail);


        if(!$user){
            return response()->api(400, 'no', 'No hay usuario', '');
        }

        $user->update(['password' => bcrypt($request->password)]);

        return response()->api(200, 'yes', '', '');
    }
}
