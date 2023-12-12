<?php

namespace App\Http\Controllers;

use App\Models\PayFee;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use App\Models\Attendance;
use Attribute;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;


class StaffController extends Controller
{
    public function viewStaffIndex()
    {
        $authStaff = Staff::where('user_id',Auth::user()->id)->first();
        return view('staff-panel.staff-index',['authStaff' => $authStaff]);
    }

    public function viewStaffLogin()
    {
        if (! Auth::user()) {
            return view('staff-panel.login');
        } else {
            return redirect()->route('dashboard.staff');
        }
    }

    public function loginStaff(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = Staff::where('email', $request->email)->first();
        if ($user) {
            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();
                return redirect()->route('dashboard.staff');
            } else {
                return redirect()->back()->with('login-faild', 'Login credentials are not correct');
            }
        } else {
            return redirect()->back()->with('email-faild', 'Login credentials are not correct');
        }
    }

    public function logoutStaff()
    {
        Auth::logout();

        return redirect()->route('login.staff')->with('logout-successfull', 'Log out Successfull');
    }

    public function feePayView()
    {
        if (Auth::user()->user_type == 1) {
            $studentData = Student::all();

            return view('staff-panel.fee-pay', [
                'studentsData' => $studentData,
            ]);
        }
    }

    public function viewAddStudentForm()
    {
        return view('staff-panel.add-student-form');
    }

    public function getStudentInfo($studentMobile)
    {
        try {
            $studentDeatials = Student::where('mobile_no', $studentMobile)->first();
            if ($studentDeatials) {
                return response()->json([
                    'status' => true,
                    'student' => $studentDeatials,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No student found with this mobile no',
                ], 200);
            }

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

    public function storeFee(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'fee_amount' => 'required',
            'payment_mode' => 'required',
            'remark' => 'required',
            'mobile_no' => 'required',
        ]);

        if (Auth::user()->user_type == '1') {
            $staff = Staff::where('user_id', Auth::user()->id)->first();

            PayFee::create([
                'student_id' => $request->student_id,
                'fee_amount' => $request->fee_amount,
                'payment_mode' => $request->payment_mode,
                'remark' => $request->remark,
                'mobile_no' => $request->mobile_no,
                'staff_id' => $staff->id,
            ]);

            return redirect()->route('listing.fee')->with('success', 'Fee Pay Successfully');
        } else {
            return redirect()->back()->with('success', 'Fee Pay Successfully');
        }
    }

    public function viewListFee()
    {
        $data = PayFee::all();

        return view('staff-panel.fee-listing', [
            'data' => $data,
            'i' => 1,
        ]);
    }

    public function viewListStudentFiltered($class)
    {
        $students = Student::where('class', $class)->get();

        return view('staff-panel.student-listing-staff', [
            'students' => $students,
            'i' => 1,
            'class' => $class,
        ]);
    }

    public function viewListStudent()
    {
        $staffId = Staff::where('user_id', Auth::user()->id)->pluck('id');
        $students = Student::where('created_by', $staffId)->get();

        return view('staff-panel.student-listing-staff', [
            'students' => $students,
            'i' => 1,
        ]);
    }

    public function viewDashboard()
    {
        $studentCount = Student::all()->count();
        $paidFeeCount = PayFee::all()->count();

        return view('staff-panel.dashboard', [
            'studentCount' => $studentCount,
            'paidFeeCount' => $paidFeeCount,
        ]);
    }

    public function getStaffDetails(Staff $staff)
    {
        try{
            return response()->json([
                'status' => true,
                'staffData' => $staff
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

    public function storeProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required|max:12|min:10',
            'address' => 'required',
            'staff_id' => 'required',
            'user_id' => 'required'
        ]);

        $userModelInstance = User::find($request->user_id);
        $userModelInstance->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $staffModelInstance = Staff::find($request->staff_id);
        $staffModelInstance->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
        ]);
        return redirect()->back()->with('success','staff update succesfully');
    }

    public function viewStudentAttendance()
    {
        $data = Student::all();
        return view('staff-panel.student.attendance-main',[
            'data' => $data,
        ]);
    }

    public function viewStudentAttendanceByStudent(Request $request)
    {
        $studentData = Student::all();
        $currentMonth = now();
        $monthName = $currentMonth->format('F');
        $daysInMonth = $currentMonth->daysInMonth;
        $currentYear = $currentMonth->year;

        return view('staff-panel.student.attendance-student',[
            'studentData' => $studentData,
            'i' => 1,
            'daysInMonth' => $daysInMonth,
            'monthName' => $monthName,
            'selctYear' => $currentYear
        ]);
    }

    public function viewAttendanceByMonthYear(Request $request)
    {
        $studentData = Student::all();
        $monthName = $request->month;

        $monthNumber = $request->month;
        $date = Carbon::createFromDate(date('Y'), $monthNumber, 1);
        $monthName = $date->format('F');
        $daysInMonth = $date->daysInMonth;

        return view('staff-panel.student.attendance-student',[
            'studentData' => $studentData,
            'i' => 1,
            'daysInMonth' => $daysInMonth,
            'monthName' => $monthName,
            'selctYear' => $request->year
        ]);
    }

    public function storeStudentAttendanceByStudent(Request $request)
    {
        $attendanceExist = Attendance::where('student_id',$request->student_id)
                            ->where('day',$request->day)
                            ->where('month',$request->month)
                            ->where('year',$request->year)->first();

        $monthNumber = Carbon::createFromFormat('F', $request->month)->month;
        if($attendanceExist)
        {
            $attendanceExist->update([
                'status' => $request->status
            ]);

            return redirect()->route('attendance.year.month',
                [
                    'month' => $monthNumber,
                    'year' => $request->year,
                ]
            )->withInput();

        }else{

            $staff = Staff::where('user_id',Auth::user()->id)->first();
            Attendance::create([
                'student_id' => $request->student_id,
                'status' => $request->status,
                'staff_id' => $staff->id,
                'day' => $request->day,
                'month' => $request->month,
                'year' => $request->year,
            ]);

            return redirect()->route('attendance.year.month',
                [
                    'month' => $monthNumber,
                    'year' => $request->year,
                ]
            )->withInput();
        }
    }

}
