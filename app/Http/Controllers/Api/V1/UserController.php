<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(){
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    public function show(User $user){    
        return response()->json(['data' => $user], 200);
    }

    // Store
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'firstname' => 'required|string|max:255',
            'othername' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|in:m,f',
            'identity_number' => 'required|string|max:255|unique:users,identity_number',
            'index_number' => 'nullable|string|max:255|unique:users,index_number',
            'is_staff' => 'required|boolean',
            'program_id' => 'nullable|integer|exists:programs,id',
            'class_group_id' => 'nullable|integer|exists:class_groups,id',
            'email' => 'required|email|unique:users,email',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }
    
        try {
            // Create a new user
            $validated = $validator->validated();

          // if class_group_id is null, assign program's class group with the least year
            if ($request->class_group_id == null) {
                // Find the program by its id
                $program = Program::find($validated['program_id']);
                
                // Get the program's class groups, sort them by 'year', and assign the first one to 'class_group_id'
                $validated['class_group_id'] = $program->class_groups->sortBy('year')->first()->id ?? null;
            }

            $user = new User();
            $user->fill($validated);
            $user->password = bcrypt($request->password); // Encrypt the password
            $user->save();
    
            return response()->json(['message' => 'User created successfully!', 'data' => $user], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store user due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }
    

    // Update
    public function update(Request $request, User $user)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'firstname' => 'required|string|max:255',
            'othername' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|in:m,f',
            'identity_number' => 'required|string|max:255|unique:users,identity_number,' . $user->id,
            'index_number' => 'nullable|string|max:255|unique:users,index_number,' . $user->id,
            'is_staff' => 'required|boolean',
            'program_id' => 'nullable|integer|exists:programs,id',
            'class_group_id' => 'nullable|integer|exists:class_groups,id',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }
    
        try {
            // Update the user
            $validated = $validator->validated();
            $user->fill($validated);
    
            // Update the password only if provided
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
    
            $user->save();
    
            return response()->json(['message' => 'User updated successfully!', 'data' => $user], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update user due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }
    

    // Delete
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete user: ' . $e->getMessage()], 500);
        }
    }


}
