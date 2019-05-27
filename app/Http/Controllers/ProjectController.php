<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function store(Request $request) {

        $validation = $request->validate([
            'name' => 'required|unique:projects',
        ]);
        try{
//            dd($request->all()['name']);
            $project = Project::create($validation);
            return response()->json([
                'message' => 'Project Created',
                'status' => 200,
                'data' => $project,
            ], 200);

        }catch(\Exception $e){

            return $e->getMessage();
        }
    }

    public function index() {

        try {
            $project = Project::all();
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $project,
            ], 200);

        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function show(Project $project) {

        try {
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $project
            ], 200);

        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function update(Request $request, Project $project) {
        try{

            $project->update($request->all());

            return response()->json([
                'message'=>'Project updated!',
                'status'=>200,
                'data'=> $project
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function destroy(Project $project) {

        try{

            $project->delete();
            return response()->json([
                'message'=>'Project Deleted!',
                'status'=>200,
                'data'=> null
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }

    public function findGroup(Request $request, Project $project) {

        try{

            $groups = $project->groups;
//            dd($groups);
            return response()->json([
                'message'=>'OK!',
                'status'=>200,
                'data'=> $groups
            ], 200);

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
