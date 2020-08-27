<?php

namespace App\Http\Controllers\HomePages;

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
}
