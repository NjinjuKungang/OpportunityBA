<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        //
    }

    /**
     * Register a newly created user in storage.
     */
    public function Register(StoreUserRequest $request)
    {
       // The incoming request is valid

        // Retrieve the validated input data

        $validated = $request->validated();

        //Create new user

        $user = new User();
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->user_type = $validated['user_type'];
        if($user->user_type == 'applicant') {
            $user->catgory = $validated['category'];
        }

        $user->save();

        auth()->login($user);

        // send response
        return response()->json([
            'status' => 1,
            'message' => 'User created successfully'
        ]);

    }


    /**
     * Display the specified resource.
     */
    public function login(LoginUserRequest $request)
    {
        // The incoming request is valid

        // Retrieve the validated input data

        $validated = $request->validated();

        // Check credentials
        $user = User::where('email', $validated['email'])->first();

        if(isset($user->id)){

            if(Hash::check($validated['password'], $user->password)){
            // Create token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Send a response
            return response()->json([
               'status' => 1,
               'message' => 'User logged in successfully',
               'access_token' => $token,
               'data' => $user
            ], 200);
            } else {
                return response()->json([
                   'status' => 0,
                   'message' => 'Password did not match',
                ], 401);
            }

        } else {
            return response()->json([
               'status' => 0,
               'message' => 'Invalid credentials, student not found'
            ], 401);
        }
    }

    /**
     * Remove the specified resource session from the cache.
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
           'status' => 1,
           'message' => 'User logged out successfully'
        ]);
    }
}
