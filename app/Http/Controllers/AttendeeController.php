<?php

namespace App\Http\Controllers;

use App\Attendees;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function add(Request $request){
        if (Attendees::all()->where('data_id', $request->input('id'))->count() > 0){
            return response()->json([
                'status' => 302,
                'message' => 'User already registered as an attendee',
            ], 302);
        }
        try{
            $attendee = new Attendees();
            $attendee->data_id = $request->input('id');
            $attendee->save();
            return response()->json([
                'status' => 201,
                'message' => 'Attendee registered successfully',
                'data' => Attendees::with('data')->find($attendee->id)
            ], 201);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 401,
                'message' => $exception->getMessage(),
            ], 401);
        }


    }
    //
}
