<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

    public function index()
    {
        $data['students']=Student::get();
        return view('web.student.show')->with($data);
    }
    public function show()
    {
        return view('web.student.add');
    }

    public function store(Request $request)
    {
        
        $request->validate([

            'name'=>'required|min:5|unique:students,name',
            'email'=>'required|min:10|string|unique:students,email',
            'img'=>'required|image',

        ]);

        $img = request()->file('img');
        $studentimg=$img->store('students', ['disk' => 'uploads']);
        
        Student::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'img'=>$studentimg,
            
        ]);


        
        $request->session()->flash('msg','student added succesfuly');
        return back();
    }

    public function edit($id)
    {
        $data['student']=Student::FindOrFail($id);
        return view('web.student.edit')->with($data);
    }

    public function update(Request $request,$id)
    {
        $student=Student::FindOrFail($id);
        $request->validate([
            'name'=>"required|string|min:4|max:30|unique:students,name,$id",
            'email'=>"required|string|max:25|unique:students,email,$id",
        ]);

        if($request->hasfile('img'))
        {
            $img='uploads/'.$student->img;
            File::delete($img);
            $img = request()->file('img');
            $studentimg=$img->store('students', ['disk' => 'uploads']);
            $student->update([
                'img'=>$studentimg,
            ]);
        }

        $student->update([

            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        $request->session()->flash('msg','student updated succesfuly');
        return back();
    

    
    }

    public function delete($id)
    {
        $student = Student::FindOrFail($id);
        
       
        unlink("uploads/".$student->img);
      
        

        Student::where("id", $student->id)->delete();
        

       
        return back();
    }

    public function search(Request $request)
    {

        //echo $word;
        $search=$request->word;


        $students=Student::where('name','like',"%$search%")->get();


        // if($request->email)
        // {
        //    $students=Student::where('email','like',"%$request->email%")->get();
        // }

        // if($request->id)
        // {
        //    $students=Student::where('id','like',"%$request->id%")->get();       
        // }
     
        return view('web.student.search',['students'=>$students]);

    }
}

