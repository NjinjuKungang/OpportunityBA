<?php

namespace App\Http\Controllers;

use App\Mail\OpportunityAlert;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OpportunityController extends Controller
{
    public function postOpportunity(Request $request){
        $request->validate([
            'title' => ['required', 'min:8'],
            'category' => ['required'],
            'image' => ['required', 'mimes:png,jpg,jpeg'],
            'description' => ['required'],
        ]);

        if($request->has('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/opportunity/';
            $file->move($path, $filename);

        }
    
        $opportunity = new Opportunity();
        $opportunity->title = $request['title'];
        $opportunity->category = $request['category'];
        $opportunity->image = $path.$filename;
        $opportunity->description = $request['description'];
        $opportunity->user_id = Auth::id();

        $opportunity->save();

        $applicants = User::where('catgory', $opportunity->category)->get();
        foreach($applicants as $applicant){
            $mailData = [
                'opportunity' => $opportunity,
                'applicant' => $applicant,
            ];

            // dd($applicant->email);

            Mail::to($applicant->email)->send(new OpportunityAlert($mailData));
            // break;
            
        }

        // echo 'i am at the end' . $applicants->count();

        return redirect()->route('company', Auth::id())->with('status', 'New opportunity created successfully');

    }
}