<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.student');
    }

    public function fetchstudent()
    {
        $student = Student::all();
        return response()->json([
            'student'=> $student,

        ]);
    }


    //controller for Store

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:191',
            'lname' => 'required|max:191',
            'course' => 'required|max:191',
            'phone' => 'required|max:191',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()

            ]);
        }
        else
        {
           
            $student =  new Student;
            $student->first_name = $request->input('fname');
            $student->last_name = $request->input('lname');
            $student->course = $request->input('course');
            $student->phone = $request->input('phone');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('upload/', $filename);
                $student->image = $filename;
            }
        

            $student->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Student Image And Data Added Successfully'
            ]);
            
        }
    }

    //controller for edit
    public function edit($id)
    {
        $student = Student::find($id);
        if($student)
        {
            return response()->json([
                'status'=>200,
                'student'=>$student
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Student Not Found'
            ]);
        }
    }

    //controller for update
    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'fname' => 'required|max:191',
        'lname' => 'required|max:191',
        'course' => 'required|max:191',
        'phone' => 'required|max:191',
        // 'image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'errors' => $validator->messages()
        ]);
    } else {
        $student = Student::find($id);
        if ($student) {
            $student->first_name = $request->input('fname');
            $student->last_name = $request->input('lname');
            $student->course = $request->input('course');
            $student->phone = $request->input('phone');

            if ($request->hasFile('image')) {
                $path = 'upload/' . $student->image;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('upload/', $filename);
                $student->image = $filename;
            }

            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Student Image And Data Updated Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404, // Changed from 200 to 404
                'message' => 'Student Not Found'
            ]);
        }
    }
}

   // controller for delete
   
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student)
        {

            $path = 'upload/'.$student->image;
            if(File::exists($path))
            {
                File::delete($path);
            }


            $student->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student Image has been deleted'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Student Not Found'
            ]);
        }
    }





}