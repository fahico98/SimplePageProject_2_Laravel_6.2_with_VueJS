<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Talk;

class MessagesController extends Controller{

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(){
      $user = Auth::user();
      return $user->talks_received->merge($user->talks_sended);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request){

   }

   /**
    * Store a newly created Talk instance in database.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function newTalk(Request $request){
      return response()->json(
         DB::table("talks")->insert([
            "sender_id" => Auth::user()->id,
            "recipient_id" => $request->recipient_id
         ])
      );
   }

   /**
    * Get every Talk instances in which authenticated user is involved.
    *
    * @return \Illuminate\Http\Response
    */
   public function talks(){
      return response()->json(
         Talk::where("sender_id", Auth::user()->id)
            ->orWhere("recipient_id", Auth::user()->id)
            ->orderBy("updated_at", "desc")
            ->offset(20 * ($page - 1))
            ->limit(20)
            ->get()
      );
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
