<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class RoleUserController extends Controller
{
    // Store
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'role_id' => 'required|integer|exists:roles,id',
            'subjectable_id' => 'nullable|integer',
            'subjectable_type' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Create a new RoleUser
            $validated = $validator->validated();
            $role_user = new RoleUser();
            $role_user->fill($validated);
            $role_user->save();

            return response()->json(['message' => 'RoleUser created successfully!', 'data' => $role_user], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store RoleUser due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update
    public function update(Request $request, RoleUser $role_user)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'role_id' => 'required|integer|exists:roles,id',
            'subjectable_id' => 'nullable|integer',
            'subjectable_type' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Update the RoleUser
            $validated = $validator->validated();
            $role_user->fill($validated);
            $role_user->save();

            return response()->json(['message' => 'RoleUser updated successfully!', 'data' => $role_user], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update RoleUser due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }


    // Destroy
    public function destroy(RoleUser $role_user)
    {
        try {
            $role_user->delete();
            return response()->json(['message' => 'RoleUser deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to delete RoleUser due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }


}
