<?php

namespace App\Http\Controllers\Teacher;

use App\Assignment;
use App\AssignmentAnswer;
use App\Course;
use App\CourseContent;
use App\User;
use App\Grade;
use App\Student;
use App\Subject;
use App\Teacher;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Parent_;
use App\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use File;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:teacher|administrator',['except' => [
            'showResources','viewResources','showCreateCoursePage','showCourseContent','viewCourseEpisoid','coursePayment','saveCoursePayment'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isA('teacher')){
            $student = count(Student::all());
            $parent = count(Parent_::all());
            $teacher = count(Teacher::all());
            return view('teacher.index')->with(['student'=>$student,'parent'=>$parent,'teacher'=>$teacher]);
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
        $subject = Subject::all();

        return view('teacher.teacherRegister')->with(['subjects'=> $subject]);
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
            'pno'  => ['required'],
            'subject'  => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->attachRole('teacher');

        $user->teacher()->create([
            'subject_id' => $data['subject'],
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'phone_number' => $data['pno'],
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
        $teacher = Teacher::find($id);
        return view('teacher.profileDetails')->with(['teacher'=>$teacher]);
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
        
        $dataSet->teacher()->update([
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

        return redirect(route('teacher.index'));
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
            if(auth()->user()->teacher->profile_image){
                Storage::delete('/public/profileImages/'.auth()->user()->teacher->profile_image);
            }

            $filename = $request->image->getClientOriginalname();
            $request->image->storeAs('profileImages',$filename,'public');
            auth()->user()->teacher()->update(['profile_image'=> $filename]);
            return redirect()->back();
        }
    }

    public function getAllDetails(){
        $teachers = Teacher::all();
        return view('teacher.allTeacherDetails')->with(['teachers'=>$teachers]);
    }

    public function showClasses(){
        $teacher = Teacher::find(auth()->user()->teacher->id);
        $teacher_grades = $teacher->grade()->paginate(10);
        $grades = Grade::all();
        // return $grades;
        return view('teacher.classes')->with(['grades'=> [$teacher_grades,$grades]]);
    }

    // public function attendanceShowClasses(){
    //     $teacher = Teacher::find(auth()->user()->teacher->id);
    //     $teacher_grades = $teacher->grade;
    //     // $grades = Grade::all();
    //     // return $grades;
    //     return view('teacher.attendance')->with(['grades'=> $teacher_grades]);
    // }

    public function resourcesShowClasses(){
        $teacher = Teacher::find(auth()->user()->teacher->id);
        $teacher_grades = $teacher->grade()->paginate(10);
        // $grades = Grade::all();
        // return $grades;
        return view('teacher.resources')->with(['grades'=> $teacher_grades]);
    }

    public function resourcesUploadForm($grade){
        return view('teacher.upload-resources')->with(['grade_id'=> $grade]);
    }

    public function resourcesUpload(Request $request,$grade_id){
        $filename='';
        // $file_extension='';

        $request->validate([
            'capter' => ['required','max:255'],
            'title'  => ['required','max:255'],
            'file' => ['required']
        ]);



        if($request->file){
            $filename = auth()->user()->teacher->id.$grade_id.'-'.$request->file->getClientOriginalname();
            $request->file->storeAs('public/resources',$filename);
        }

        $newResource = Resource::create(['grade_id'=>$grade_id,'teacher_id'=>auth()->user()->teacher->id,'capter'=>$request->capter, 'title'=> $request->title, 'file'=> $filename]);
        $filename='';
        return redirect()->back()->with('success','New Resources Uploaded.');
    }

    public function editResourcesForm($id){
        $resources = Resource::find($id);
        return view('teacher.edit-resources')->with(['resources'=>$resources]);
    }

    public function editResources(Request $data,$id){
        $data->validate([
            'capter' => ['required','max:255'],
            'title'  => ['required','max:255']
        ]);
        Resource::where('id',$id)->update(['capter'=>$data->capter,'title'=>$data->title]);
        return redirect()->back()->with('success','Resources Updated.');
    }

    public function viewResources($grade_id,$teacher_id){

        // $teacher = Teacher::find($teacher_id)
        $resources = Resource::where([
            ['grade_id', '=',$grade_id],
            ['teacher_id', '=',$teacher_id]
        ])->paginate(10);
        // return $resources;
        return view('teacher.view-resources')->with(['resources'=>$resources]);
    }

    public function showResources($id){
        $file = Resource::find($id);
        return view('teacher.show-resources')->with(['file'=>$file]);
    }

    public function editResourcesFileForm($id){
        $resources = Resource::find($id);
        return view('teacher.edit-resources-file')->with(['resources'=>$resources]);
    }

    public function editResourcesFile(Request $request,$id){
        $filename='';
        // $file_extension='';

        $request->validate([
            'file' => ['required']
        ]);



        if($request->file){
            $oldfile = Resource::find($id);
            $filename = auth()->user()->teacher->id.$oldfile->grade_id.'-'.$request->file->getClientOriginalname();
            Storage::delete('/public/resources/'.$oldfile->file);

            
            $request->file->storeAs('public/resources',$filename);
            Resource::where('id',$id)->update(['file'=>$filename]);
        }
        $filename='';
        return redirect()->back()->with('success','Resources Updated.');
    }

    public function deleteResources($id){
        $resource = Resource::find($id);
        Storage::delete('/public/resources/'.$resource->file);
        Resource::where('id',$id)->delete();

        return redirect()->back()->with('success','Resource deleted successfully.');
    }

    public function quizes(){
        return view('teacher.quizes');
    }


    public function addClasses(Request $request){
        $request->validate(['selected'=> 'required']);

        $grade = $request->selected;
        // $gradeid = Grade::where('grade',$grade)->get('id');
        $gradeid = $request->selected;
        $user = Teacher::find(auth()->user()->teacher->id);
        $user->grade()->attach($gradeid);
        return redirect(route('showClasses'));
    }

    public function showGradeStudentList($grade_id){
        $teacher = Teacher::find(auth()->user()->teacher->id);
        $student_teachers = $teacher->student;
        $student_id = [];
        foreach($student_teachers as $student_teacher){
            $student_id[] = $student_teacher->id;
        }
        
        $students = Student::where('grade_id',$grade_id)->whereIn('id',$student_id)->paginate(10);
        return view('teacher.teacher-student')->with(['students'=>$students]);
    }

    public function showCreateCoursePage(){
        if(auth()->user()->isA("teacher")){
            $courses = Course::where('teacher_id',auth()->user()->teacher->id)->get();
            return view('teacher.showCourses')->with(['courses'=>$courses]);
        }
        else if(auth()->user()->isA("student")){
            $courses = Course::all();
            return view('teacher.showCourses')->with(['courses'=>$courses]);
        }
       
    }

    public function showCreateCourseForm(){
        return view('teacher.createCourse');
    }

    public function addCourses(Request $request){
        $filename='';
        // $file_extension='';

        $request->validate([
            'title'  => ['required','max:255'],
            'category'  => ['required','max:255'],
            'image' => ['required'],
            'price' => ['required','numeric']
        ]);



        if($request->image){
            $filename = auth()->user()->teacher->id.'-'.$request->image->getClientOriginalname();
            $request->image->storeAs('public/course_image',$filename);
        }

        $newCourse = Course::create(['teacher_id'=>auth()->user()->teacher->id,'category'=>$request->category, 'title'=> $request->title, 'image'=> $filename, 'price'=>$request->price, 'publish'=>0]);
        $filename='';
        return redirect(route("showCourse"))->with('success','New Courses Added.');
    }

    public function publishCourse($id){
        $dataSet = Course::find($id);

        if($dataSet['publish']==0){
            $dataSet->update(
                [
                    'publish' => 1
                ]
                );
        }
        elseif($dataSet['publish']==1){
            $dataSet->update(
                [
                    'publish' => 0
                ]
                );
        }
      
       
        return redirect(route('showCourse'));
    }

    public function addCourseContentForm($id){
        return view('teacher.addCourseContent')->with(['id'=>$id]);
    }

    public function saveCourseContent($id, Request $request){
        $filename='';
        // $file_extension='';

        $request->validate([
            'title'  => ['required','max:255'],
            'file' => ['required']
        ]);



        if($request->file){
            $filename = auth()->user()->teacher->id.'-'.$id.'-'.$request->file->getClientOriginalname();
            $request->file->storeAs('public/course_resources',$filename);
        }

        $newCourseContent= CourseContent::create(['course_id'=>$id, 'title'=> $request->title, 'file'=> $filename]);
        $filename='';


        return redirect(route('showCourse')) ;
    }

    public function showCourseContent($id){
        $contents  = CourseContent::where('course_id',$id)->get();
        return view('teacher.showCourseContent')->with(["contents"=>$contents]);
    }

    public function viewCourseEpisoid($id){
        $file = CourseContent::find($id);
        return view('teacher.viewCourseCapter')->with(['file'=>$file]);
    }

    public function deleteCourseEpisoid($id){
        $resource = CourseContent::find($id);
        Storage::delete('/public/course_resources/'.$resource->file);
        CourseContent::where('id',$id)->delete();

        return redirect()->back()->with('success','Resource deleted successfully.');
    }

    public function coursePayment($id){
        $course  = Course::where('id',$id)->get();
        // return $course;
        return view('teacher.coursePayment')->with(['course'=>$course]);
    }

    // public function saveCoursePayment($id){
    //     $course= Course::where('id',$id)->get();
    //     $payment = Payment::create(['amount'=>$course[0]['price'],'student_id'=>auth()->user()->student->id,'course_id'=>$id]);
    //     return redirect(route('showCourse'))->with('success','Payement successfully.');
    // }

    public function assignmentsShowClasses(){
        $teacher = Teacher::find(auth()->user()->teacher->id);
        $teacher_grades = $teacher->grade()->paginate(10);
        return view('teacher.assignment')->with(['grades'=> $teacher_grades]);
    }

    public function assignmentCreatedForm($id){

        return view('teacher.assignmentsCreatedForm')->with(['grade_id'=> $id]);
    }

    public function createAssingnment($gid, Request $request){
        $filename='';
        // $file_extension='';

        $request->validate([
            'description' => ['required','max:255'],
            'title'  => ['required','max:255'],
            'file' => ['required']
        ]);

        $extension = strtolower($request->file->extension());

        if($extension != 'pdf'){
            return redirect()->back()->with('warning','Please select a pdf file.');
        }




        if($request->file){
            $filename = auth()->user()->teacher->id.$gid.'-'.$request->file->getClientOriginalname();
            $request->file->storeAs('public/assignments',$filename);
        }

        $assignment = Assignment::create(['teacher_id'=>auth()->user()->teacher->id,'grade_id'=>$gid,'title'=>$request->title, 'due_date'=> $request->dueDate, 'file'=> $filename,'description'=>$request->description, 'publish'=>0]);
        $filename='';
        return redirect()->back()->with('success','New Assignment Created.');

    }

    public function viewSubmissions($grade,$teacher){
        $assignments = Assignment::where('grade_id',$grade)->where('teacher_id',$teacher)->paginate(10);
        return view('teacher.viewSubmission')->with(['assignments'=> $assignments]);
    }

    public function publishLink($aid){
        $dataSet = Assignment::find($aid);
        if($dataSet['publish']==0){
            $dataSet->update(
                [
                    'publish' => 1
                ]
                );
        }
        elseif($dataSet['publish']==1){
            $dataSet->update(
                [
                    'publish' => 0
                ]
                );
        }
        return redirect(route('viewSubmissions',[$dataSet['grade_id'],$dataSet['teacher_id']]));
    }

    public function allSubmission($aid){
        $submissions = AssignmentAnswer::where('assignment_id',$aid)->get();
        return view('teacher.assignmentSubmission')->with(['submissions'=>$submissions,'aid'=>$aid]);
    }

    public function downloadAllSubmissions($aid){
        $assignment = Assignment::find($aid);
        $submissions = AssignmentAnswer::where('assignment_id',$aid)->get();
        $zip = new ZipArchive;
        $filename = 'assignment('.$assignment['title'].').zip';
        if($zip->open(public_path($filename),ZipArchive::CREATE)==TRUE){
            $files = File::files(public_path('storage/assignmentAnswer'));
            foreach($files as $key=> $value){
                $relativeName = basename($value);
                foreach($submissions as $submission){
                    if($relativeName == $submission['file']){
                        $zip->addFile($value,$relativeName);
                    }
                }
            }
            $zip->close();
            return response()->download(public_path($filename));
        }

    }

    public function downloadOneSubmission($sid){
        $submissions = AssignmentAnswer::where('id',$sid)->get();
        $zip = new ZipArchive;
        $filename = '('.$submissions[0]->student->name.').zip';
        if($zip->open(public_path($filename),ZipArchive::CREATE)==TRUE){
            $files = File::files(public_path('storage/assignmentAnswer'));
            foreach($files as $key=> $value){
                $relativeName = basename($value);
                foreach($submissions as $submission){
                    if($relativeName == $submission['file']){
                        $zip->addFile($value,$relativeName);
                        break;
                    }
                }
            }
            $zip->close();
            return response()->download(public_path($filename));
        }

        
    }

    public function editAssignmentForm($aid){
        $assignment = Assignment::find($aid);
        return view('teacher.editAssignmentForm')->with(['assignment'=>$assignment]);
    }

    public function editAssignment(Request $request,$aid){
       

        $dataSet = Assignment::find($aid);

        $dataSet->update(
             [
                 'due_date' => $request['dueDate1']
             ]
             );

             return redirect()->back()->with('success','Due date changed.');
    }

}
