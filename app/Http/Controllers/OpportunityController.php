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
    public function createPage()
    {
        $user = User::get('id');
        return view('opportunity/create', compact('user'));
    }

    public function readPage($id)
    {   
        $opportunity = Opportunity::find($id);
        return view('opportunity/read', ['opportunity' => $opportunity]);
    }

    public function editPage($id)
    {
        $opportunity = Opportunity::find($id);
        // dd($opportunity);
        return view('opportunity/update', ['opportunity' => $opportunity]);
    }

    public function updatePage(Request $request, Opportunity $opportunity){
        // dd($opportunity);

        $request->validate([
            'title' => ['', 'min:8'],
            'category' => [''],
            'image' => ['mimes:png,jpg,jpeg'],
            'description' => [''],
        ]);

        if($request->has('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/opportunity/';
            $file->move($path, $filename);

        }
    
        $opportunity->title = $request['title'];
        // dd($opportunity->title);
        $opportunity->category = $request['category'];
        // $opportunity->image = $path.$filename;
        $opportunity->description = $request['description'];

        $opportunity->save();

        return redirect()->route('company', Auth::id())->with('status', 'Opportunity updated successfully');
    }

    public function deleteOpp($id){
        $opportunity = Opportunity::find($id);
        $opportunity->delete();

        return redirect()->route('company', Auth::id())->with('status', 'Opportunity deleted successfully');
    }
        
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