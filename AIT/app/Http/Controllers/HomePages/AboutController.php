<?php

namespace App\Http\Controllers\HomePages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index(){
        session()->forget('home');
        session()->forget('contact');
        session()->put('about','about');

        return view('homePages.about');
    }
}
