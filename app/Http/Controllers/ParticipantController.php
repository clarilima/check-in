<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    //
    public function store(Request $request) {

        $validation = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'birth' => 'required',
            'group_id' => 'required'
        ]);
        try{
//            dd($request->all()['name']);
            $participant = Participant::create($validation);
            return response()->json([
                'message' => 'Participant Created',
                'status' => 200,
                'data' => $participant,
            ], 200);

        }catch(\Exception $e){

            return $e->getMessage();
        }
    }

    public function index() {

        try {
            $participant = Participant::all();
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $participant,
            ], 200);

        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function show(Participant $participant) {

        try {
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $participant
            ], 200);

        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function update(Request $request, Participant $participant) {
        try{

            $participant->update($request->all());

            return response()->json([
                'message'=>'Participant updated!',
                'status'=>200,
                'data'=> $participant
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function destroy(Participant $participant) {

        try{
            $participant->delete();
            return response()->json([
                'message'=>'Participant Deleted!',
                'status'=>200,
                'data'=> null
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }

    public function findMeeting(Request $request, Participant $participant){
        try{

            $meetings = $participant->meetings;
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $meetings
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
