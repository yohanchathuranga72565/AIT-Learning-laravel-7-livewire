<?php

namespace App\Http\Controllers\HomePages;

use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        session()->forget('about');
        session()->forget('contact');
        session()->put('home','home');
        return view('homePages.home');
    }

    public function allowPermisionSubject($sid,$tid){
        
        $teacher = Teacher::find($tid);
        $teacher->student()->attach($sid);

        $subject = Subject::find($teacher->subject->id);
        $subject->student()->attach($sid);
        return redirect(route('login'));
        // return $sid;
    }
}
