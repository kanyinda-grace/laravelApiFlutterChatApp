<?php

namespace App\Http\Controllers;
use App\Http\Resources\ConversationRessource;
use App\Models\Conversation;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$conversations = Conversation::where('user_id',auth::user()->id)->orWhere('seconde_user_id',auth::user()->id)->orderBy('updated_at', 'desc')->get();

$count = count($conversations);
       // $array = []

  for ($i=0; $i < $count ; $i++) { 
      for ($j=$i +1; $j < $count; $j++) { 
          
          if ($conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id) {
                 $temp = $conversations[$i];
                 $conversations[$i] = $conversations[$j];
                 $conversations[$j] = $temp;

          }
      }
  }
          
          return ConversationRessource::collection($conversations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
