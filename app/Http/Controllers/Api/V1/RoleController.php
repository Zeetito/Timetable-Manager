<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index(){
        $roles = Role::all();
        return response()->json(['data' => $roles], 200);
    }

    public function show(Role $role){    
        return response()->json(['data' => $role], 200);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
            'slug' => 'required|string|max:255|unique:roles,slug',
            'level' => 'required|integer',
            'subject_type' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Create a new role
            $validated = $validator->validated();
            $role = new Role();
            $role->fill($validated);
            $role->save();

            return response()->json(['message' => 'Role created successfully!', 'data' => $role], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store role due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Role $role)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->id,
            'level' => 'required|integer',
            'subject_type' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Update the role
            $validated = $validator->validated();
            $role->fill($validated);
            $role->save();

            return response()->json(['message' => 'Role updated successfully!', 'data' => $role], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update role due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response()->json(['message' => 'Role deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to delete role due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }



}
