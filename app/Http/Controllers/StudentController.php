<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Attribute;
use Auth;

class StudentController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == '0') {
            $studentDetails = Student::where('email', Auth::user()->email)->first();

            return view('panel.index-student', [
                'studentDetails' => $studentDetails,
            ]);
        } else {
            return redirect()->route('home.staff');
        }
    }

    public function viewAttendance()
    {
        $student = Student::where('user_id',Auth::user()->id)->first();
        $attendance = Attendance::where('student_id',$student->id)->get();
        // dd($attendance);

        return view('panel.attendance.attendance',[
            'studentDetails' => $student,
            'i' => 1,
            'attendance' => $attendance
        ]);
    }
}
