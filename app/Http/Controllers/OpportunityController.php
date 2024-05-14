<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OpportunityController extends Controller
{
    public function postOpportunity(Request $request){
        $request->validate([
            'title' => ['required', 'min:8'],
            'image' => ['required', 'mimes:png,jpg,jpeg'],
            'description' => ['required'],
            'user_id' => ['required'],
        ]);

        if($request->has('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;
            $path = 'uploads/opportunity/';
            $file->move($path, $filename);
        }
    
        $opportunity = new Opportunity();
        $opportunity->title = $request['tile'];
        $opportunity->image = $path.$filename;
        $opportunity->description = $request['description'];
        $opportunity->user_id = $request['user_id'];

        $opportunity->save();

        return redirect()->route('company')->with('status', 'New opportunity created');

    }
}