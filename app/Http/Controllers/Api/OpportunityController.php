<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreOpportunityRequest;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OpportunityController extends Controller
{
    /**
     * Store a newly created opportunity in storage.
     */
    public function store(StoreOpportunityRequest $request)
    {
        // The incoming request is valid

        // Retrieve the validated input data

        $validated = $request->validated();

        // User id + create project
        $user_id = auth()->user()->id;

        if (User::where([
            'id' => $user_id,
            'user_type' => 'Company'
        ])->exists()) 
        {
            $opportunity = new Opportunity();

            $opportunity->user_id = $user_id;
            $opportunity->title = $validated['title'];
            // $opportunity->image = $validated['image'];
            $opportunity->description = $validated['description'];
            $opportunity->category = $validated['category'];

            $opportunity->save();

            // Send response
            return response()->json([
            'message' => 'Opportunity has been created successfully',
                'data' => $opportunity
            ], 201);
        } else {
            return response()->json([
                'message' => 'You are not allowed to create a project'
             ], 403);
        }
       
    }

    /**
     * Display a listing of opportunities.
     */
    public function index()
    {
        $user = auth()->user();

        if(User::where([
            'id' => $user->id,
            'user_type' => 'Company',
        ])->exists()){

            $opportunities = Opportunity::where('user_id', $user->id)->get();

            // Send response
            return response()->json([
                'status' => 1,
                'message' => 'Your created Opportunities',
                'data' => $opportunities
            ], 200);
        } 
        elseif (User::where([
            'id' => $user->id,
            'user_type' => 'applicant',
        ])->exists()) 
        {
            $opportunities = Opportunity::where([
                'category' => $user->catgory
            ])->get();
            if ($opportunities == []) {
                return response()->json([
                   'status' => 0,
                   'message' => 'No available Opportunities for ' . $user->catgory . ' category'
                ], 200);
            }
            // Send response
            return response()->json([
                'status' => 1,
                'message' => 'Available Opportunities for '. $user->catgory . ' category',
                'data' => $opportunities
            ], 200);


        } else {
            $opportunities = Opportunity::all();

            // Send response
            return response()->json([
               'status' => 1,
               'message' => 'Available Opportunities'
            ], 200);
        }

    }
    /**
     * Display the specified opportunity.
     */
    public function show($id)
    {
        // Getting corresponding user id + project id f specific project
        $user = auth()->user();
        if(Opportunity::where([
            'id' => $id,
           'user_id' => $user->id
          ])->exists()) 
        {
            $project = Opportunity::where([
                'id' => $id,
               'user_id' => $user->id
              ])->first();

        // Send response
            return response()->json([
               'status' => 1,
               'message' => 'Project details',
                'data' => $project
            ], 200);
        } else {

            return response()->json([
               'status' => 0,
               'message' => 'Project not found'
            ], 404);
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified opportunity from storage.
     */
    public function destroy($id)
    {
        $user_id = auth()->user()->id;
        if(Opportunity::where([
            'id' => $id,
           'student_id' => $user_id
          ])->exists())
        {
            $Opportunity = Opportunity::where([
                'id' => $id,
               'user_id' => $user_id
            ])->first();
            
            $Opportunity->delete();

            return response()->json([
               'status' => 1,
               'message' => 'Opportunity has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
               'status' => 0,
               'message' => 'Opportunity not found'
            ], 404);
        }
    }
}
    
    
    
    