<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Hashtag;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $hashtags = Hashtag::all();
        
        $obj = array();
        foreach($hashtags as $hashtag){
            $obj[]=array('text'=>$hashtag->name);
        }

        return response()->json($obj);
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
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'tag'      => 'required|unique:hashtags,name',
        ]);
        if ($validator->fails()) {
            //Formato de Macro respuesta JSON
            return response()->api(400,'no', 'Error insert hashtag, repeated', '');
        }

        $tag = $req->input( 'tag' );
        $hashtag = new Hashtag();
        
        //Hashtag en minúsculas
        $hashtag->name = strtolower($tag);
        
        //Añade Hashtag a la tabla hashtags mysql
        $hashtag->save();

        //$user = User::find($id);
        //$user->hashtag()->attach($id); //this executes the insert-query

        //Formato de Macro respuesta JSON
        return response()->api(200,'yes', 'Success saving new hashtag', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

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

        Log::debug('tagcontroller destroy');
        //Eliminar tag de mysql
        $hashtag = Hashtag::where('name', $id)->firstOrFail();
        
        try {
           //Añade Hashtag a la tabla hashtags mysql
            $hashtag->delete();
            return response()->api(200,'yes', 'Success saving new hashtag', '');
        } catch (Exception $e) {
            Log::error("Failed deleting the user hashtagh from hashtags");
            Log::error($e->getMessage());
        
            return response()->api(400,'no', 'Failed deleting hashtag', '');
        }
    }
}
