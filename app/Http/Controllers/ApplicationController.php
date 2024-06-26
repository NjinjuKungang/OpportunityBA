<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationAlert;
use App\Models\Application;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{

    public function getApplication($id): View
    {
        $opportunity = Opportunity::find($id);

        if(Auth::check()){
            return view('opportunity/apply-auth', ['id' => $opportunity,'opportunity' => $opportunity]);
        }
        else {
            return view('opportunity/apply', ['id' => $opportunity,'opportunity' => $opportunity]);
        }
    }

    public function postApplication(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'min:8'],
            'phone' => ['nullable'],
            'email'=> ['nullable', 'email'],
            'cv' => ['required', 'mimes:pdf'],
            'reason' => ['required'],
        ]);

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



        return redirect()->route('dashboard.landing')->with('status', 'Opportunity has been applied for!!!');

    }
}
