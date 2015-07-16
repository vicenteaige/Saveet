<?php

namespace App\Http\Controllers;

use Auth;

use Log;
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

        $logItem = 'loginReqAPI: '.$request->email.' '.$request->password;
        Log::debug($logItem);

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
            $outcome = 'yes';
            $error = '';
        }
        else {
            $outcome = 'no';
            $error = 'Wrong email and password combination';
        }
        // return redirect('/home');
        return response()->json([
                [
                    'header' => [
                        'success' => $outcome,
                        'msg' => $error
                    ]
                ]
        ]);
    }

    public function apiLogOutUser()
    {
        if (Auth::logout()) {
            $outcome = 'yes';
            $error = '';
        }
        else {
            $outcome = 'no';
            $error = 'No user to logout';
        }
        return response()->json([
                [
                    'header' => [
                        'success' => $outcome,
                        'msg' => $error
                    ]
                ]
        ]);
    }
}
