<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //

    public function store(Request $request) {

        $validation = $request->validate([
            'name' => 'required|unique:groups',
            'project_id' => 'required'
        ]);
        try{
//            dd($request->all()['name']);
            $group = Group::create($validation);
            return response()->json([
                'message' => 'Project Created',
                'status' => 200,
                'data' => $group,
            ], 200);

        }catch(\Exception $e){

            return $e->getMessage();
        }
    }

    public function index() {

        try {
            $group = Group::all();
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $group,
            ], 200);

        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function show(Group $group) {

        try {
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $group
            ], 200);

        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function update(Request $request, Group $group) {
        try{

            $group->update($request->all());

            return response()->json([
                'message'=>'Project updated!',
                'status'=>200,
                'data'=> $group
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function destroy(Group $group) {

        try{
            $group->delete();
            return response()->json([
                'message'=>'Project Deleted!',
                'status'=>204,
                'data'=> null
            ], 204);

        }catch(\Exception $e){
            return $e->getMessage();
        }



    }
}
