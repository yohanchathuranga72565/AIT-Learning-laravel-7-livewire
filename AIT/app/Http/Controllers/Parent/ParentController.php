<?php

namespace App\Http\Controllers\Parent;
use App\User;
use App\Parent_;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ParentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:parent|administrator|teacher');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isA('parent')){
            $user = count(User::all());
            $student = count(Student::all());
            $parent = count(Parent_::all());
            $teacher = count(Teacher::all());
            return view('parent.index')->with(['user'=>$user,'student'=>$student,'parent'=>$parent,'teacher'=>$teacher]);
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
        return view('parent.parentRegister');
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
            'occupation'  => ['required', 'string', 'max:100'],
            'address'  => ['required', 'string', 'max:255'],
            'pno'  => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->attachRole('parent');

        $user->parent()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'occupation' => $data['occupation'],
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
        $parent = Parent_::find($id);
        return view('parent.profileDetails')->with(['parent'=>$parent]);
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
            'occupation' => ['required', 'string', 'max:255'],
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
        
        $dataSet->parent()->update([
            'name' => $data['name'], 
            'address' => $data['address'], 
            'phone_number' => $data['pno'],
            'dob' => $data['dob'],  
            'occupation' => $data['occupation'],
        ]);

        // $id->update(
        //     [
        //         'name' => $data['name'],   
        //         'email' => $data['email'],
        //     ]
        // );

        return redirect(route('parent.index'));
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
            if(auth()->user()->parent->profile_image){
                Storage::delete('/public/profileImages/'.auth()->user()->parent->profile_image);
            }

            $filename = $request->image->getClientOriginalname();
            $request->image->storeAs('profileImages',$filename,'public');
            auth()->user()->parent()->update(['profile_image'=> $filename]);
            return redirect()->back();
        }
    }
    
    public function getAllDetails(){
        // $parents = Parent_::all();
        $parents = [];
        if(auth()->user()->isA('administrator')){
            $parents = Parent_::paginate(10);
        }
        else if(auth()->user()->isA('teacher')){
            $teacher = Teacher::find(auth()->user()->teacher->id);
            $students = $teacher->student;
            // $parents = $students->parent;
            $student_id = [];
            $parent_id = [];
            foreach($students as $student){
                $student_id[] = $student->id;
                $parent_id[] = $student->parent__id;
            }
            $parents = Parent_::whereIn('id',$parent_id)->paginate(10);
        } 
      
        return view('parent.allParentDetails')->with(['parents'=>$parents]);
    }

    public function linkStudent($id){
        Student::where('id',$id)->update(['parent__id'=>auth()->user()->parent->id]);
        return redirect(route('getLinkedStudent',auth()->user()->parent->id));
    }

    public function getLinkedStudent($id){
        $students = Parent_::find($id)->student;
        return view('parent.linkedStudentList')->with(['students'=>$students]);
    }

}
