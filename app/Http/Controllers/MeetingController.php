<?php

namespace App\Http\Controllers;

use App\Group;
use App\Meeting;
use App\Participant;
use App\Project;
use function foo\func;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function index(Request $request) {
        if($request->wantsJson()){
            $source = Meeting::all();
            return DataTables::of($source)->
            addColumn('showUrl', function (Meeting $meeting){
                return route('meeting.show', $meeting->id);
            })->make(true);

        }
//        try {
//            $meetings = Meeting::all();
//
////            return response()->json([
////                'message'=>'OK!',
////                'status'=>200,
////                'data'=> $meeting,
////            ], 200);
//
//        }catch (\Exception $e) {
//            return $e->getMessage();
//        }
        return view('site.projects');
    }

    public function show(Request $request, Meeting $meeting) {

        $projects = Project::all();
        if($request->wantsJson()){

//            dd($request->idGroup);
            $source = Participant::all();
            if($request->idGroup != null){
               $source = Group::find($request->idGroup)->participants;
            }

            return DataTables::of($source)->
            addColumn('checkMeeting', function ($participant) use ($meeting){
                $check = $participant->presences()->where('meeting_id', $meeting->id)->get();

                if($check->count() > 0){
                    return 1;
                }
                return 0;
            })->make(true);
        }
//        try {
//
//
////            return response()->json([
////                'message'=>'OK!',
////                'status'=>200,
////                'data'=> $meeting
////            ], 200);
//
//        }
//        catch (\Exception $e) {
//            return $e->getMessage();
//        }
        return view('site.meeting-check', compact('meeting', 'projects'));

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

    public function meetingCreate() {
        return view('site.meeting-create');
    }

}
