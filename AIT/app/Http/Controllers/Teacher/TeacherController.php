<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:teacher');
    }

    public function index()
    {
        return view('teacher.index');
    }
}
