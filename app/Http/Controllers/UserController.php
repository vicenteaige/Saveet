<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string',
            'email'      => 'required|email|unique:users,email',
            'twitter_username' => 'string',
            'password'   => 'required|confirmed|string',
            'password_confirmation' => 'required|string'
        ]);
        if($validator->fails()){
            $outcome = 'no';
            $error = 'Some field is wrong';
        }
        else {
            $newuser = new User();
            $newuser->name = $request->name;
            $newuser->email = $request->email;
            $newuser->twitter_username = $request->twitter_username;
            $newuser->password = bcrypt($request->password);
            $newuser->save();

            $outcome = 'yes';
            $error = '';
        }
        return response()->json(
            [
                'header' => [
                    'success' => $outcome,
                    'msg' => $error
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function apiLogUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email',
            'password'   => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                [
                    'header' => [
                        'success' => 'no',
                        'msg' => 'Invalid email or password format'
                    ]
                ]
            ]);
        }

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $httpStatus = 200;
            $outcome = 'yes';
            $error = '';
        }
        else {
            $httpStatus = 401;
            $outcome = 'no';
            $error = 'Wrong email and password combination';
        }
        return response()->api($httpStatus, $outcome, $error, '');
    }

    public function apiLogOutUser()
    {
        Auth::logout();
        if (!Auth::check()) {
            $outcome = 'yes';
            $error = '';
        }
        else {
            $name = Auth::getUser()->name;
            $outcome = 'no';
            $error = 'User: '.$name ;
        }
        return response()->json(
            [
                'header' => [
                    'success' => $outcome,
                    'msg' => $error
                ]
            ]
        );
    }

    public function apiGetLoggedUser() {
        $outcome = 'ok';
        $message = Auth::getUser()->name;
        return response()->json(
            [
                'header' => [
                    'success' => $outcome,
                    'msg' => $message
                ]
            ]
        );
    }
}
