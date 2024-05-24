<?php

namespace App\Http\Controllers;

use App\Mail\OpportunityAlert;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
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
        $opportunity->title = $validated['title'];
        $opportunity->category = $validated['category'];
        $opportunity->image = $path.$filename;
        $opportunity->description = $validated['description'];
        $opportunity->user_id = Auth::id();

        $opportunity->save();

        $applicants = User::where('catgory', $opportunity->category)->get();
        foreach($applicants as $applicant){
            $mailData = [
                'opportunity' => $opportunity,
                'applicant' => $applicant,
            ];


            Mail::to($applicant->email)->send(new OpportunityAlert($mailData));
            
        }

        return redirect()->route('dashboard.company')->with('message', 'New opportunity created successfully');

    }


    public function readPage($id): View
    {   
        $opportunity = Opportunity::find($id);
        return view('opportunity/read', ['opportunity' => $opportunity]);
    }


    public function editPage($id): View
    {
        $opportunity = Opportunity::find($id);
        return view('opportunity.update', ['id' => $opportunity, 'opportunity' => $opportunity]);
    }

    public function update(Request $request, Opportunity $opportunity): RedirectResponse
    {
        $validated = $request->validate([
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
    
        $opportunity->title = $validated['title'];
        $opportunity->category = $validated['category'];
        // $opportunity->image = $path.$filename;
        $opportunity->description = $validated['description'];

        $opportunity->save();

        return redirect()->route('dashboard.company')->with('message', 'Opportunity updated successfully...');
    }


    public function destroy($id): RedirectResponse
    {
        $id = Opportunity::find($id);
        $id->delete();

        return redirect()->route('dashboard.company')->with('message', 'Opportunity deleted successfully...');
    }
        
   
}