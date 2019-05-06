<?php

namespace App\Http\Controllers;

use App\Attendees;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function add(Request $request){
        try{
            $attendee = new Attendees();
            $attendee->data_id = $request->input('id');
            $attendee->save();
            return response()->json([
                'status' => 200,
                'message' => 'Attendee registered successfully',
                'data' => Attendees::with('data')->find($attendee->id)
            ], 200);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 401,
                'message' => $exception->getMessage(),
            ], 401);
        }


    }
    //
}
