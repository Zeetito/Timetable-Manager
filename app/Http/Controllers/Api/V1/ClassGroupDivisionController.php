<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ClassGroup;
use Illuminate\Http\Request;
use App\Models\ClassGroupDivision;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ClassGroupDivisionController extends Controller
{

    public function show(ClassGroupDivision $classGroupDivision){
        return response()->json(['data' => $classGroupDivision], 200);
    }

    public function index(){
        $classGroupDivisions = ClassGroupDivision::all();
        return response()->json(['data' => $classGroupDivisions], 200);
    }

    // Store
    public function store(Request $request){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'class_group_id' => 'required|integer',
            'users_id' => 'required|array',  // Validate as an array
            'users_id.*' => 'integer',       // Ensure each element is an integer
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // Get the validated data
        $validated = $validator->validated();

        // Create new ClassGroupDivision
        $classGroupDivision = new ClassGroupDivision();
        $classGroupDivision->name = $validated['name'];
        $classGroupDivision->class_group_id = $validated['class_group_id'];
        $classGroupDivision->users_id = $validated['users_id'];  // JSON array

        try {
            if ($classGroupDivision->save()) {
                // tag the classgroup as divided
                $classGroup = ClassGroup::find($validated['class_group_id']);
                $classGroup->is_divided = 1;
                $classGroup->save();

                return response()->json(['message' => 'ClassGroupDivision created successfully!', 'data' => $classGroupDivision], 201);
            } else {
                return response()->json(['error' => 'Failed to save the ClassGroupDivision.'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create ClassGroupDivision due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Update
    public function update(Request $request, ClassGroupDivision $classGroupDivision){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'class_group_id' => 'required|integer',
            'users_id' => 'required|array',  // Validate as an array
            'users_id.*' => 'integer',       // Ensure each element is an integer
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // Get the validated data
        $validated = $validator->validated();

        // Update ClassGroupDivision attributes
        $classGroupDivision->name = $validated['name'];
        $classGroupDivision->class_group_id = $validated['class_group_id'];
        $classGroupDivision->users_id = $validated['users_id'];  // JSON array

        try {
            if ($classGroupDivision->save()) {
                return response()->json(['message' => 'ClassGroupDivision updated successfully!', 'data' => $classGroupDivision], 200);
            } else {
                return response()->json(['error' => 'Failed to update the ClassGroupDivision.'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to update ClassGroupDivision due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Delete
    public function destroy(ClassGroupDivision $classGroupDivision){
        // Get the users_id of the division being deleted
        $usersToDistribute = $classGroupDivision->users_id;
        
        // Find other classGroupDivisions that belong to the same class_group_id
        $remainingDivisions = ClassGroupDivision::where('class_group_id', $classGroupDivision->class_group_id)
                                                ->where('id', '!=', $classGroupDivision->id)
                                                ->get();

        // Check if there are any remaining divisions
        if ($remainingDivisions->count() > 0) {
            // Calculate the number of users to distribute to each remaining division
            $usersChunk = array_chunk($usersToDistribute, ceil(count($usersToDistribute) / $remainingDivisions->count()));

            // Distribute the users among the remaining divisions
            foreach ($remainingDivisions as $index => $division) {
                $currentUsers = $division->users_id;
                $mergedUsers = array_merge($currentUsers, $usersChunk[$index] ?? []);  // Distribute chunk if it exists

                // Update the users_id of the division with the newly merged users (ensure no duplicates)
                $division->users_id = array_unique($mergedUsers);
                $division->save();
            }
        }

        try {
            // Now delete the classGroupDivision
            if ($classGroupDivision->delete()) {
                return response()->json(['message' => 'ClassGroup Division deleted successfully!'], 200);
            } else {
                return response()->json(['error' => 'Failed to delete the ClassGroupDivision.'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete ClassGroupDivision due to database error: ' . $e->getMessage()], 500);
        }
    }


        // Divide a classgroup into multiple divisions
    public function divide(Request $request, ClassGroup $classgroup){

        // check if classGroup is already divided
        if ($classgroup->is_divided) {
            return response()->json(['error' => 'ClassGroup is already divided.'], 400);
        }

        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'number_of_divisions' => 'required|integer', 
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        $users_id = $classgroup->users()->pluck('id')->toArray();

        $users_count = count($users_id);

        // randomise usersId
        shuffle($users_id);

        // Calculate the number of users to distribute to each division
        $usersChunk = array_chunk($users_id, ceil($users_count / $request->number_of_divisions));

        // Distribute the users among the divisions
        foreach ($usersChunk as $index => $users) {
            $classgroup->divisions()->create([
                'name' => chr($index + 65),//65 = A
                'class_group_id' => $classgroup->id,
                'users_id' => $users,  // Distribute chunk
            ]);
        }

        $classgroup->is_divided = 1;
        $classgroup->save();

        return response()->json(['message' => 'ClassGroup Divided successfully!'], 200);

    }
    




}

