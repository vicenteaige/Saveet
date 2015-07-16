<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;

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
    public function store()
    {
        //
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
        if (Auth::logout()) {
            $httpStatus = 200;
            $outcome = 'yes';
            $error = '';
        }
        else {
            $httpStatus = 400;
            $outcome = 'no';
            $error = 'No user to logout';
        }
        return response()->api($httpStatus, $outcome, $error, '');
    }
}
