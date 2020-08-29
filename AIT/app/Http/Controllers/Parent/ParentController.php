<?php

namespace App\Http\Controllers\Parent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:parent');
    }

    public function index()
    {
        return view('parent.index');
    }
}
