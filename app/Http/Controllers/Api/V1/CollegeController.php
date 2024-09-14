<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CollegeController extends Controller
{

    // Show
    public function show(College $college){
        return response()->json(['data' => $college], 200);
    }
    
    // Index
    public function index(){
        $colleges = College::all();
        return response()->json(['data' => $colleges], 200);
    }

    // Store
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            // 'location' => 'required'
        ]);

        $college = new College();
        $college->name = $validated['name'];
        // $college->location = $validated['location'];
    
        try {
            if ($college->save()) {
                // If save is successful
                return response()->json(['message' => 'College created successfully!', 'data' => $college], 201);
            } else {
                // If save fails, return a general error
                return response()->json(['error' => 'Failed to save the college.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the college already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to create college due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Update
    public function update(Request $request, College $college){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|unique:colleges,name,',
            'name' => 'required',
            'location'=>'nullable',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return a custom error response
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        };

        // Update the college
        $college->name = $request->name;
        $college->location =$request->location;

        $college->save();

        return response()->json(['message' => 'College updated successfully!', 'data' => $college], 201);
    }

    // Delete
    public function destroy(College $college){
        if($college->delete()){
            return response()->json(['message' => 'College deleted successfully!'], 200);
        }else{
            return response()->json(['error' => 'Failed to delete the college.'], 500);
        }

    }
}
