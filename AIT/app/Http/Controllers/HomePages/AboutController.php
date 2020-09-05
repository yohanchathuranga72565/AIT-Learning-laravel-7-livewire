<?php

namespace App\Http\Controllers\HomePages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;

class AboutController extends Controller
{
    public function index(){
        session()->forget('home');
        session()->forget('contact');
        session()->put('about','about');

        $teachers = Teacher::all();
        // dd($teachers);

        return view('homePages.about')->with(['teachers'=>$teachers]);
    }
}
