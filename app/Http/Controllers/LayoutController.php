<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function landingPage()
    {
        $opportunities = Opportunity::get();
        return view('layouts/landing', compact('opportunities'));
    }

    public function signUpPage()
    {
        return view('layouts/sign-up');
    }

    public function createOpportunity()
    {
        $user = User::get('id');
        return view('opportunity/createOpp', compact('user'));
    }

    public function readOpportunity($id)
    {   
        $opportunity = Opportunity::find($id);
        return view('opportunity/readOpp', ['opportunity' => $opportunity]);
    }

    public function updateOpportunity($id)
    {
        $opportunity = Opportunity::find($id);
        // dd($opportunity);
        return view('opportunity/updateOpp', ['opportunity' => $opportunity]);
    }

    public function updateOpp(Request $request, Opportunity $opportunity){
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

    public function deleteOpportunity($id){
        $opportunity = Opportunity::find($id);
        $opportunity->delete();

        return redirect()->route('company', Auth::id())->with('status', 'Opportunity deleted successfully');
    }

    public function loginPage()
    {
        return view('layouts/login');
    }

}
