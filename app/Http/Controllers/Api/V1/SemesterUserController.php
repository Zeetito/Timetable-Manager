<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Semester;
use App\Models\SemesterUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class SemesterUserController extends Controller
{
    //
    public function storeOrUpdate(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'semester_id' => 'required|integer|exists:semesters,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Get validated data
            $validated = $validator->validated();

            // Check if a SemesterUser entry already exists for the user
            $semesterUser = $request->user()->semester_user;

            if ($semesterUser) {
                // If it exists, update the semester_id

                // if the input is same as active semesterid, delete and return
                if($validated['semester_id'] == Semester::getActiveSemester()->id){
                    $semesterUser->delete();
                }else{

                    $semesterUser->update([
                        'semester_id' => $validated['semester_id']
                    ]);
                }

                return response()->json(['message' => 'SemesterUser updated successfully!', 'data' => $semesterUser], 200);
            } else {
                // Check if the new being created is same a sactive
                if($validated['semester_id'] == Semester::getActiveSemester()->id){
                    return response()->json(['message' => 'No Change made!', 'data' => $semesterUser], 201);
                    
                }else{

                    $semesterUser = SemesterUser::create($validated);
                    return response()->json(['message' => 'SemesterUser created successfully!', 'data' => $semesterUser], 201);
                }

                // If no entry exists, create a new one
            }
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store or update SemesterUser due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete
    public function destroy(Request $request){
        $user = $request->user();
        $semester_user = $user->semester_user;

        if($semester_user){
            $semester_user->delete();
            return response()->json(['message' => 'SemesterUser deleted successfully!'], 200);
        }

        return response()->json(['message' => 'SemesterUser not found!'], 404);
    }

}
