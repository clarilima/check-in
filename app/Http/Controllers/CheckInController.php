<?php

namespace App\Http\Controllers;

use App\Presence;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    //
    public function check(Request $request) {

        try{
            $meeting = Presence::create($request->all());
            return response()->json([
                'message' => 'Checked',
                'status' => 200,
                'data' => $meeting,
            ], 200);

        }catch(\Exception $e){

            return $e->getMessage();
        }
    }

    public function checkOut(Request $request, $participant, $meeting){

        try{
            $source = Presence::where('participant_id', $participant)->
            where('meeting_id', $meeting)->delete();
            return response()->json([
                'message'=>'Participante Checkd Out',
                'status'=>200,
                'data'=> null
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
