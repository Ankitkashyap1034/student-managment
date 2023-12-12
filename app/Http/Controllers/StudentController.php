<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Attribute;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


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
        $currentMonth = now();
        $monthName = $currentMonth->format('F');
        $daysInMonth = $currentMonth->daysInMonth;
        $currentYear = $currentMonth->year;
        $currentDay = $currentMonth->day;
        // dd($monthName);

        $student = Student::where('user_id',Auth::user()->id)->first();
        $attendance = Attendance::where('student_id',$student->id)
                        ->where('month',$monthName)
                        ->where('year',$currentYear)->get();


        return view('panel.attendance.attendance',[
            'month' => $monthName,
            'year' => $currentYear,
            'studentDetails' => $student,
            'i' => 1,
            'attendance' => $attendance
        ]);
    }

    // function for see attendance from year and month filter
    public function viewAttendanceStudentByMonthYear(Request $request)
    {

        $monthNumber = $request->month;
        $year = $request->year;
        $selectedDate = Carbon::createFromDate($year, $monthNumber, 1);
        $daysInMonth = $selectedDate->daysInMonth;

        $date = Carbon::createFromDate(date('Y'), $monthNumber, 1);
        $monthName = $date->format('F');

        $student = Student::where('user_id',Auth::user()->id)->first();
        $attendance = Attendance::where('student_id',$student->id)
                        ->where('month',$monthName)
                        ->where('year',$request->year)
                        ->orderBy('day', 'asc')->get();

        // dd($attendance);
        return view('panel.attendance.attendance',[
            'monthNumber' => $monthNumber,
            'selctedYear' => $request->year,
            'studentDetails' => $student,
            'i' => 1,
            'attendance' => $attendance,
            'daysInMonth' => $daysInMonth
        ]);
    }
}
