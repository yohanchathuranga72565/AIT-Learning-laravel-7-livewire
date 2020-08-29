<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:student|adminisitrator');
        // $this->middleware('role:student|adminisitrator'); different role access
    }

    public function index()
    {
        return view('student.index');
    }
}
