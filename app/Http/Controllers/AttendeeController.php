<?php

namespace App\Http\Controllers;

use App\Attendees;
use App\Data;
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

    public function verifyAttendee(Request $request){
        if (!$request->has('uuid')){
            return response()->json([
                'status' => 400,
                'message' => 'The uuid field is required'
            ], 200);
        }
        $uuid = $request->input('uuid');
        $data = Data::all()->where('uuid', $uuid);
        if ($data->isNotEmpty()){
            return response()->json([
                'status' => 200,
                'message' => 'User retrieved successfully',
                'data' => $data->first()
            ], 200);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'The user wasn\'t found'
            ], 200);
        }
    }

    public function addAttendee(Request $request){
        if (!$request->has('id')){
            return response()->json([
                'status' => 400,
                'message' => 'The ID field is required'
            ], 400);
        }
        $id = $request->input('id');
        $attendee = Attendees::all()->where('user_id', $id);
        if ($attendee->isEmpty()){
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
        } else {
            return response()->json([
                'status' => 302,
                'message' => 'User already registered as an attendee',
            ], 302);
        }
    }
    //
}
