<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreOpportunityRequest;
use App\Http\Requests\UpdateOpportunityRequest;
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
     * Displays all opportunities for unauthenticated users.
     */
    public function index(Request $request)
    {
        $opportunities = Opportunity::query();
        
        //  Filter by start and end dates
        if(!empty($request->startDate) && !empty($request->startDate)) {
            $opportunities = $opportunities->where('created_at', '>=', $request->startDate)
                                ->where('created_at', '<=', $request->endDate);
        }

        // Filter by text search results
        if(!empty($request->search)){
            $opportunities = $opportunities->where('title', 'like', '%'. $request->keyword. '%')
                ->orWhere('description', 'like', '%'. $request->keyword. '%');
        }

        //  Filter by category
        if($request->category){
            $opportunities = $opportunities->where('category', 'like', '%'. $request->category. '%');
        }

        // Sort opportunities by specific field order
        if(!empty($request->sortBy) && !empty($request->sortOrder)){
            $opportunities = $opportunities->orderBy($request->sortBy, $request->sortOrder);
        }

        // Obtain Opportunities and paginate results
        $opportunities = $opportunities->paginate(5);

        // Send response
        return response()->json([
            'status' => 1,
            'message' => 'Available Opportunities',
            'data' => $opportunities
        ], 200);
    }


    /**
     * Display a listing of opportunities for authenticated users.
     */
    public function showAll(Request $request)
    {
        $user = auth()->user();

        if(User::where([
            'id' => $user->id,
            'user_type' => 'Company',
        ])->exists()){

            $opp_query = Opportunity::query()->where('user_id', $user->id);

            // Filter by start and end dates
            if(!empty($request->startDate) && !empty($request->startDate)) {
                $opportunities = $opp_query->where('created_at', '>=', $request->startDate)
                                    ->where('created_at', '<=', $request->endDate);
            }
            
            // Filter by text search results
            if(!empty($request->search)){
                $opp_query
                    ->where('title', 'like', '%'. $request->keyword. '%')
                    ->orWhere('description', 'like', '%'. $request->keyword. '%');
                    
            }

            // Filter by category
            if($request->category){
                $opp_query->where('category', 'like', '%'. $request->category. '%');
            }

            // Obtain all results after checking various queries
            $opp_query->get();

            // Paginate results
            $opportunities=$opp_query->paginate(1);

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
            $opp_query = Opportunity::query()->where([ 'category' => $user->catgory ]);
            
            // Filter by start and end dates
            if(!empty($request->startDate) && !empty($request->startDate)) {
                $opportunities = $opp_query->where('created_at', '>=', $request->startDate)
                                    ->where('created_at', '<=', $request->endDate);
            }

            // Filter by text search results
            if($request->search){
                $opp_query
                    ->where('title', 'like', '%'. $request->keyword. '%')
                    ->orWhere('description', 'like', '%'. $request->keyword. '%');
            }
            
             // Sort opportunities by specific field order
            if(!empty($request->sortBy) && !empty($request->sortOrder)){
                $opportunities = $opportunities->orderBy($request->sortBy, $request->sortOrder);
            }
            
            // Obtain all results after checking various queries
            $opp_query->get();

            // Paginate results
            $opportunities=$opp_query->paginate(1);
            
            if ($opportunities == null) {
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
    public function update(UpdateOpportunityRequest $request, $id)
    {

        $validated = $request->validated();

        if(Opportunity::where('id', $id)->exists()){
            $opportunity = Opportunity::find($id);

            $opportunity->name = !empty($validated['name']) ? $validated['name'] : $opportunity->name;
            $opportunity->email = !empty($validated['email']) ? $validated['email'] : $opportunity->email; 
            $opportunity->phone_no = !empty($validated['phone_no']) ? $validated['phone_no'] : $opportunity->phone_no;
            $opportunity->gender = !empty($validated['gender']) ? $validated['gender'] : $opportunity->gender;
            $opportunity->age = !empty($validated['age']) ? $validated['age'] : $opportunity->age;
        
            $opportunity->save();

            return response()->json([
                'status' => 1,
               'message' => 'Employee updated successfully',
            ], 203);

        } else {
            return response()->json([
            'status' => 0,
            'message' => 'Employee not found',
            ], 404);
        }
    }
    /**
     * Remove the specified opportunity from storage.
     */
    public function destroy($id)
    {
        $user_id = auth()->user()->id;
        if(Opportunity::where([
            'id' => $id,
           'user_id' => $user_id
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
    
    
    
    