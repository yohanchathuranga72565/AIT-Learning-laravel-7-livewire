<?php

namespace App\Http\Controllers\Student;

use App\Assignment;
use App\AssignmentAnswer;
use App\User;
use App\Grade;
use App\Student;
use App\Teacher;
use App\Resource;
use Illuminate\Http\Request;
use App\Mail\GetSubjectPermission;
use App\Http\Controllers\Controller;
use App\Parent_;
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
            $user = count(User::all());
            $student = count(Student::all());
            $parent = count(Parent_::all());
            $teacher = count(Teacher::all());
            return view('student.index')->with(['user'=>$user,'student'=>$student,'parent'=>$parent,'teacher'=>$teacher]);
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

    // public function studentViewResources($grade_id,$teacher_id){

    //     // $teacher = Teacher::find($teacher_id)
    //     $resources = Resource::where([
    //         ['grade_id', '=',$grade_id],
    //         ['teacher_id', '=',$teacher_id]
    //     ])->get();
    //     // return $resources;
    //     return view('teacher.view-resources')->with(['resources'=>$resources]);
    // }


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

    public function assignments($tid){
        $gid = auth()->user()->student->grade->id;
        $assignments = Assignment::where('teacher_id',$tid)->where('grade_id',$gid)->get();
        $uploaded = AssignmentAnswer::where('student_id',auth()->user()->student->id)->get();
        return view('student.assignment')->with(['assignments'=>$assignments,'answers'=>$uploaded]);
    }

    public function assignmentView($file){
        return view('student.assignmentView')->with(['file'=>$file]);
    }

    public function uploadAssignment($aid){
        // $dname = AssignmentAnswer::where('assignment_id',$aid)->where('student_id',auth()->user()->student->id)->get('file');
        // return $dname[0]['file'];
        $assignment = Assignment::where('id',$aid)->get();
        return view('student.assignmentsAnswer')->with(['assignment'=>$assignment]);
    }

    public function saveAssignment(Request $request , $aid){
        // $image = $request->file('file');
            $dname = AssignmentAnswer::where('assignment_id',$aid)->where('student_id',auth()->user()->student->id)->get('file');
            if(isset($dname[0]['file'])){
                $set = AssignmentAnswer::where('assignment_id',$aid)->where('student_id',auth()->user()->student->id)->delete();
                Storage::delete('/public/assignmentAnswer/'.$dname[0]['file']);
            }
            
            
    
            $filename = $aid.'-'.auth()->user()->student->id.'-'.$request->file->getClientOriginalname();
            $request->file('file')->storeAs('public/assignmentAnswer',$filename);

            $answer = AssignmentAnswer::create(['file'=>$filename, 'assignment_id' => $aid,'student_id'=>auth()->user()->student->id]);

        return response()->json(['success'=>$filename]);
    }

    public function removeAssignmentInDropbox(Request $request, $aid){
        $filename = $request->filename;
        $filename = $aid.'-'.auth()->user()->student->id.'-'.$filename;
        Storage::delete('/public/assignmentAnswer/'.$filename);
        $assigment = AssignmentAnswer::where('file',$filename)->delete();
       

        return $filename;
    }
}
