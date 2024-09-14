<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{

    public function index(){
        $rooms = Room::all();
        return response()->json(['data' => $rooms], 200);
    }

        // Store
        public function store(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'nullable',
                'department_id' => 'nullable',
                'floor' => 'required',
                'type' => 'required',
                'exams_cap' => 'nullable',
                'reg_cap' => 'nullable',
                'max_cap' => 'nullable',
                'location' => 'nullable',
            ]);
            
            // Check if validation fails
            if ($validator->fails()) {
                // If validation fails, return a custom error response
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $validator->errors()
                ], 422);
            }
            
            // If validation passes, get the validated data
            $validated = $validator->validated();

            
    
            $room = new Room();
            $room->name = $validated['name'];
            $room->slug = $validated['slug'];
            $room->department_id = $validated['department_id'];
            $room->floor = $validated['floor'];
            $room->type = $validated['type'];
            $room->exams_cap = $validated['exams_cap'];
            $room->reg_cap = $validated['reg_cap'];
            $room->max_cap = $validated['max_cap'];
            $room->location = $validated['location'];
        
            try {
                if ($room->save()) {
                    // If save is successful
                    return response()->json(['message' => 'Room created successfully!', 'data' => $room], 201);
                } else {
                    // If save fails, return a general error
                    return response()->json(['error' => 'Failed to save the room.'], 500);
                }
            } catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return response()->json(['error' => 'Duplicate entry, the room already exists.'], 409);
                }
                return response()->json(['error' => 'Failed to create room due to database error: ' . $e->getMessage()], 500);
            }
    
        }

        public function update(Request $request, Room $room){
            // Create a validator instance
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'nullable',
                'department_id' => 'nullable',
                'floor' => 'required',
                'type' => 'required',
                'exams_cap' => 'nullable',
                'reg_cap' => 'nullable',
                'max_cap' => 'nullable',
                'location' => 'nullable',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                // If validation fails, return a custom error response
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $validator->errors()
                ], 422);
            }

            // Get the validated data
            $validated = $validator->validated();

            // Update room attributes
            $room->name = $validated['name'];
            $room->slug = $validated['slug'];
            $room->department_id = $validated['department_id'];
            $room->floor = $validated['floor'];
            $room->type = $validated['type'];
            $room->exams_cap = $validated['exams_cap'];
            $room->reg_cap = $validated['reg_cap'];
            $room->max_cap = $validated['max_cap'];
            $room->location = $validated['location'];

            try {
                // Save the updated room
                if ($room->save()) {
                    return response()->json(['message' => 'Room updated successfully!', 'data' => $room], 200);
                } else {
                    return response()->json(['error' => 'Failed to update the room.'], 500);
                }
            } catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return response()->json(['error' => 'Duplicate entry, the room already exists.'], 409);
                }
                return response()->json(['error' => 'Failed to update room due to database error: ' . $e->getMessage()], 500);
            }
        }

        // Delete

        public function destroy(Room $room){
            if($room->delete()){
                return response()->json(['message' => 'Room deleted successfully!'], 200);
            }else{
                return response()->json(['error' => 'Failed to delete the Room.'], 500);
            }
        }

        // Show

        public function show(Room $room){
            return response()->json(['data' => $room], 200);
        }


}
