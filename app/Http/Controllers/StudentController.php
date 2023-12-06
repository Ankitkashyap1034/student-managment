<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Auth;

class StudentController extends Controller
{
    public function index()
    {
        $studentDetails = Student::where('email', Auth::user()->email)->first();
        return view('panel.index-student',[
            'studentDetails' => $studentDetails
        ]);
    }
}
