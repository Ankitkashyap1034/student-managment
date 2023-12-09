<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Auth;

class HomeController extends Controller
{
    public function view()
    {
        return view('pages.index');
    }

    public function viewForm()
    {
        return view('pages.add-student-form');
    }

    public function store(Request $request)
    {

        $request->validate([
            'profile_img' => 'required',
            'name' => 'required|max:100',
            'father_name' => 'required|max:100',
            'mother_name' => 'required|max:100',
            'mobile_no' => 'required|max:10|min:10|unique:student,mobile_no',
            'gender' => 'required|max:20',
            'class' => 'required|max:30',
            'email' => 'required|unique:student,email|unique:users,email',
            'address' => 'required|max:256',
            'password' => 'required|confirmed|min:6|max:10'
        ]);
        dd($request->all());
        if ($request->file('profile_img')) {
            $studentModelInstance = new Student();
            $file = $request->file('profile_img');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $path = $file->storeAs('public/student-profile-img', $filename);
            $studentModelInstance->profile_img = $filename;
        }

        // also create a user also
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        if(Auth::user()){
            if(Auth::user()->user_type == '1'){
                $staffId = Staff::where('user_id',Auth::user()->id)->first();

                Student::create([
                    'profile_img' => $filename,
                    'name' => $request->name,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'mobile_no' => $request->mobile_no,
                    'gender' => $request->gender,
                    'class' => $request->class,
                    'email' => $request->email,
                    'address' => $request->address,
                    'user_id' => $user->id,
                    'created_by' => $staffId->id
                ]);
            }
        }else{
            Student::create([
                'profile_img' => $filename,
                'name' => $request->name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'mobile_no' => $request->mobile_no,
                'gender' => $request->gender,
                'class' => $request->class,
                'email' => $request->email,
                'address' => $request->address,
                'user_id' => $user->id,
                'created_by' => 'self'
            ]);
        }


        return redirect()->route('listing')->with('success','Student Add Succesfully');

    }

    public function viewList()
    {
        if(Auth::user()){
            if(Auth::user()->user_type == '1'){
                $staffId = Staff::where('user_id',Auth::user()->id)->pluck('id');
                $students = Student::where('created_by',$staffId)->get();
            }else{
                $students = Student::all();
            }
        }
        else{
            $students = Student::all();
        }
        return view('pages.listing',[
            'students' => $students,
            'i' => 1
        ]);
    }

    public function destroy(Student $student)
    {
        try{
            // $student->delete();
            return response()->json([
                'status' => true,
            ],200);
        }catch (\Exception $ex) {
            Log::error('getClientService', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => $ex->getMessage(),
            ], 404);
        }

    }

    public function viewEditStudent(Student $student)
    {
        return view('pages.add-student-form',[
            'studentDetail' => $student
        ]);
    }

    public function viewStudent(Student $student)
    {
        try{
            return response()->json([
                'status' => true,
                'studentDetials' => $student,
            ],200);
        } catch (\Exception $ex) {
            Log::error('getClientService', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function storeEditStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'father_name' => 'required|max:100',
            'mother_name' => 'required|max:100',
            'mobile_no' => 'required|max:12',
            'gender' => 'required|max:20',
            'class' => 'required|max:30',
            'email' => 'required',
            'address' => 'required|max:256',
        ]);



        $studentModelInstance = Student::find($request->student_id);

        if($request->profile_img){
            $file = $request->file('profile_img');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $path = $file->storeAs('public/student-profile-img', $filename);
            $studentModelInstance->profile_img = $filename;
            $studentModelInstance->save();
        }

        $studentModelInstance->update([
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'mobile_no' => $request->mobile_no,
            'gender' => $request->gender,
            'class' => $request->class,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect('/staff/listing')->with('edit-successfully','Student Edit Succesfully');
    }

    public function viewFormAjax()
    {
        return view('pages.ajax-form');
    }

    public function storeStudentAjax(Request $request)
    {
        try{

            if ($request->file('profile_img')) {
                $studentModelInstance = new Student();
                $file = $request->file('profile_img');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $path = $file->storeAs('public/student-profile-img', $filename);
                $studentModelInstance->profile_img = $filename;
            }

            Student::create([
                'profile_img' => $filename,
                'name' => $request->name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'mobile_no' => $request->mobile_no,
                'gender' => $request->gender,
                'class' => $request->class,
                'email' => $request->email,
                'address' => $request->address,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Student add successfully'
            ],200);

        }catch (\Exception $ex) {
            Log::error('getClientService', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            return response()->json([
                'message' => $ex->getMessage(),
            ], 404);
        }
    }
}
