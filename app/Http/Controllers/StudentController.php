<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Auth;

class StudentController extends Controller
{
    public function index()
    {
        if(Auth::user()->user_type == '0'){
            $studentDetails = Student::where('email', Auth::user()->email)->first();
            return view('panel.index-student',[
                'studentDetails' => $studentDetails
            ]);
        }else{
            return redirect()->route('home.staff');
        }

    }
}
