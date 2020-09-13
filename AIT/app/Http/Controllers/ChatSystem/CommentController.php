<?php

namespace App\Http\Controllers\ChatSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(){
        return view('chatSystem.comments');
    }
}
