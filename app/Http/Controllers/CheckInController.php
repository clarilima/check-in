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
}
