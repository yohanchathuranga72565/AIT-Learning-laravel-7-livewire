<?php

namespace App\Http\Controllers\HomePages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        session()->forget('home');
        session()->forget('about');
        session()->put('contact','contact');
        return view('homePages.contact');
    }

    public function sendEmail(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email:rfc,dns',
            'subject' => 'required|max:50',
            'message' => 'required|max:500',
        ]);
 
        $details = [
            'subject'=> $request->subject,
            'name'=> $request->name,
            'email'=> $request->email,
            'message'=> $request->message,
        ];
        \Mail::to('aitinstitute1234@gmail.com')->send(new \App\Mail\ContactPage($details));
        return redirect()->back()->with('sentmail', 'Email has sent successfully');
    }
}
