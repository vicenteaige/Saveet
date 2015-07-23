<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Hashtag;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use Auth;
use DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $req)
    {
        
        $tag = strtolower($req->input( 'tag' ));

        $hashtags = Hashtag::where('name','LIKE', "%$tag%")->get()->take(15);//Maximo 15 resultados
        $obj = array();
        foreach($hashtags as $hashtag){
            $obj[]=array('text'=>$hashtag->name);
        }
        $resultAutocomplete['todos'] = $obj;


        $user = Auth::user();
        $user_hashtags = $user->hashtags;
        $obj2 = array();
        foreach($user_hashtags as $hashtag){
            $obj2[]=array('text'=>$hashtag->name);
        }
        $resultUserHashtags['user'] = $obj2;


        $resultFinal = array_merge($resultUserHashtags,$resultAutocomplete);

        return response()
            ->json($resultFinal)
            ->header('Content-Type', 'application/json');
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
        $tag = strtolower($req->input( 'tag' ));

        $validator = Validator::make($req->all(), [
            'tag'      => 'required|unique:hashtags,name',
        ]);

        if ($validator->fails()) {

            //Already Exists
            
       
        }else{    

            $hashtag = new Hashtag();
            $hashtag->name = $tag;
            //Insert hashtag into mysql db
            $hashtag->save();
        }
        
        //get user
        $user = Auth::user();
        //get hashtag
        $hashtag = Hashtag::where('name', $tag)->first();

        $relationExists = count(DB::select('select * from hashtag_user where hashtag_id = ? and user_id = ?', [$hashtag->id,$user->id]));
        //Check relation does not exist already
        if (($relationExists)>0)
        {
            //If relation exists 
            return response()->api(400,'no', 'Error before hashtag attachment, relation already exists', '');// exists
       
        } else{
            //if it does not exist

            //Create relation hashtag-user
            $hashtag->users()->attach($user->id); //this executes the insert-query

            //Macro format JSON response
            return response()->api(200,'yes', 'Success attaching hashtag to user', '');
        }
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

        //Get Hashtag using text from input given
        $hashtag = Hashtag::where('name', $id)->firstOrFail();
        //Get user from session
        $user = Auth::user();

       $relationExists = count(DB::select('select * from hashtag_user where hashtag_id = ? and user_id = ?', [$hashtag->id,$user->id]));
       //Check relation does exist 
       if (($relationExists)>0)
        {
            //If relation exists 
            //Delete relation user-hashtag
            $hashtag->users()->detach($user->id);
       
        } else{

            //if it does not exist
            //Macro format JSON response
            return response()->api(400,'No', 'Hashtag already detached from User, hashtag_user non existent.', '');
        }

        //refresh
        $hashtag = Hashtag::where('name', $id)->firstOrFail();

        //check if any user has it related to his account
        if(($hashtag->users->count())>0){
            
            //Don't delete from table hashtags, at least one user has it
             return response()->api(200,'yes', 'Success detaching hashtag from user.', '');

        }else{

            //No user has it

            try {

                //Delete hashtag from mysql db
                $hashtag->delete();
                return response()->api(200,'yes', 'Success deleting hashtag from db.', '');
           
            } catch (Exception $e) {

                Log::error("Failed deleting hashtagh from hashtags");
                Log::error($e->getMessage());
                return response()->api(400,'no', 'Failed deleting hashtag from hashtags', '');

            }
        }
    }
}
