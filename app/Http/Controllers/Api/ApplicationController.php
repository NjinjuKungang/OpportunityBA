<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreApplicationRequest;
use App\Mail\ApplicationAlert;
use App\Models\Application;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends RoutingController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postApplication(StoreApplicationRequest $request, $id)
    {
        
        $validated = $request->validated();

        if($request->has('cv')){
            $file = $request->file('cv');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/application/';
            $file->move($path, $filename);

        }

        $application = new Application();

        if(Auth::check()){
            $application->name = Auth::user()->name;
            $application->phone = Auth::user()->phone;
            $application->email = Auth::user()->email;
        }
        else {
       
            $application->name = $validated['name'];
            $application->phone = $validated['phone'];
            $application->email = $validated['email'];
        }
            $application->cv = $path.$filename;
            $application->reason = $request['reason'];
            $application->opportunity_id = $id;
            $application->save();
            
            $opportunity = Opportunity::find($id);
            $company = User::find($opportunity->user_id);

            // dd($opportunity->name);
            $mailApply = [
                'applicant' => $application->name,
                'admin' => $company->name,
                'opportunity' => $opportunity->name,
            
        ];

        Mail::to($company->email)->send(new ApplicationAlert($mailApply));



        return response()->json([
            'status' => 1,
            'message' => 'Opportunity has been applied for succesfully!!!',
            'data' => $application,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
