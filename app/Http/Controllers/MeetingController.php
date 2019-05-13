<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    //
    public function store(Request $request) {


        try{
            $meeting = Meeting::create($request->all());
            return response()->json([
                'message' => 'Meeting Created',
                'status' => 200,
                'data' => $meeting,
            ], 200);

        }catch(\Exception $e){

            return $e->getMessage();
        }
    }

    public function index() {

        try {
            $meeting = Meeting::all();
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $meeting,
            ], 200);

        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function show(Meeting $meeting) {

        try {
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $meeting
            ], 200);

        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function update(Request $request, Meeting $meeting) {
        try{

            $meeting->update($request->all());

            return response()->json([
                'message'=>'Meeting updated!',
                'status'=>200,
                'data'=> $meeting
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function destroy(Meeting $meeting) {

        try{
            $meeting->delete();
            return response()->json([
                'message'=>'Meeting Deleted!',
                'status'=>204,
                'data'=> null
            ], 204);

        }catch(\Exception $e){
            return $e->getMessage();
        }



    }
    public function findGroup(Request $request, Meeting $meeting) {

        try{
            $groupsMeeting = [];

            $groups = $meeting->presences()
                ->whereHas('group')->with('group')
                ->get()
                ->unique('group.name');

            foreach($groups as $group){
                $groupsMeeting[] = $group->group;
            }

            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $groupsMeeting
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
