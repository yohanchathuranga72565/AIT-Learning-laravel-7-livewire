<?php

namespace App\Http\Controllers\Student;

use App\User;
use App\Grade;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\GetSubjectPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:student|administrator|teacher');
        // $this->middleware('role:student|adminisitrator'); different role access
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isA('student')){
            return view('student.index');
        }
        else{
            return redirect(route('login'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return view('student.studentRegister')->with(['grades'=> $grades]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob'  => ['required', 'date'],
            'gender' => ['required'],
            'address'  => ['required', 'string', 'max:255'],
            'grade'  => ['required'],
            'pno'  => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->attachRole('student');

        $user->student()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'phone_number' => $data['pno'],
            'grade_id' => $data['grade'],
        ]);

        return view('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('student.profileDetails')->with(['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob'  => ['required', 'date'],
            'gender' => ['required'],
            'address'  => ['required', 'string', 'max:255'],
            'pno'  => ['required'],
        ]);

        $dataSet = User::find($id);

       $dataSet->update(
            [
                'name' => $data['name'],   
            ]
            );
        
        $dataSet->student()->update([
            'name' => $data['name'], 
            'address' => $data['address'], 
            'phone_number' => $data['pno'],
            'dob' => $data['dob'],  
        ]);

        // $id->update(
        //     [ 
        //         'name' => $data['name'],   
        //         'email' => $data['email'],
        //     ]
        // );

        return redirect(route('student.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profileUpload(Request $request){
        if($request->hasFile('image')){
            if(auth()->user()->student->profile_image){
                Storage::delete('/public/profileImages/'.auth()->user()->student->profile_image);
            }

            $filename = $request->image->getClientOriginalname();
            $request->image->storeAs('profileImages',$filename,'public');
            auth()->user()->student()->update(['profile_image'=> $filename]);
            return redirect()->back();
        }
    }

    public function getAllDetails(){
        if(auth()->user()->isA('administrator')){
            $students = Student::all();
        }
        else if(auth()->user()->isA('teacher')){
            $teacher = Teacher::find(auth()->user()->teacher->id);
            $students = $teacher->student;
        } 
        return view('student.allStudentDetails')->with(['students'=>$students]);
    }

    public function showSubjects(){
        // $teacher = Teacher::find(auth()->user()->teacher->id);
        // $teacher_grades = $teacher->grade;
        // $grades = Grade::all();
        // return $grades;
        $grade = Grade::find(auth()->user()->student->grade->id);
        $teacher = $grade->teacher;
        $student = Student::find(auth()->user()->student->id);
        $subject = $student->subject;
        return view('student.subject')->with(['teachers'=>[$teacher,$subject]]);
    }

    public function getPermisionSubject(Request $request){
        $request->validate(['selected' => 'required']);
        $teacherid = $request->selected;
        $teachers = Teacher::whereIn('id',$teacherid)->get();
        
        foreach($teachers as $teacher){ 
            $details = [
                'subject'=> "You have new student request",
                'student_name'=> auth()->user()->name,
                'student_email'=> auth()->user()->email,
                'student_id'=> auth()->user()->student->id,
                'teacher_id'=> $teacher->id,
            ];
            \Mail::to($teacher->email)->send(new \App\Mail\GetSubjectPermission($details));
        }

        return redirect()->back();

        // return new GetSubjectPermission();
        
    
        // return redirect()->back()->with('sentmail', 'Email has sent successfully');
    }
}
