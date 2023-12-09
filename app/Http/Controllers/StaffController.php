<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use App\Models\Student;
use App\Models\PayFee;
use Illuminate\Http\Request;
use Auth;

class StaffController extends Controller
{
    public function viewStaffIndex()
    {
          return view('staff-panel.staff-index');
    }

    public function viewStaffLogin()
    {
        if(!Auth::user()){
            return view('staff-panel.login');
        }else{
            return redirect()->route('home.staff');
        }
    }

    public function loginStaff(Request $request)
    {
        $request->validate([
            'email' => 'required',
             'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        $user = Staff::where('email',$request->email)->first();
        if($user){
            if (Auth::attempt($credentials)) {
                // Authentication passed, manually create a session
                $request->session()->regenerate();

                return redirect()->route('dashboard.staff');
            }else{
                return redirect()->back()->with('login-faild','Login credentials are not correct');
            }
        }else{
            return redirect()->back()->with('email-faild','Login credentials are not correct');
        }
    }

    public function logoutStaff()
    {
        Auth::logout();
        return redirect()->route('login.staff')->with('logout-successfull','Log out Successfull');
    }

    public function feePayView()
    {
        if(Auth::user()->user_type == 1){
            $studentData = Student::all();
            return view('staff-panel.fee-pay',[
                'studentsData' => $studentData
            ]);
        }
    }

    public function viewAddStudentForm()
    {
        return view('staff-panel.add-student-form');
    }

    public function getStudentInfo($studentMobile)
    {
        try{
            $studentDeatials = Student::where('mobile_no',$studentMobile)->first();
            if($studentDeatials){
                return response()->json([
                    'status' => true,
                    'student' => $studentDeatials
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'No student found with this mobile no'
                ],200);
            }

        }
        catch (\Exception $ex) {
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

        if(Auth::user()->user_type == '1'){
            $staff = Staff::where('user_id',Auth::user()->id)->first();

                PayFee::create([
                    'student_id' => $request->student_id,
                    'fee_amount' => $request->fee_amount,
                    'payment_mode' => $request->payment_mode,
                    'remark' => $request->remark,
                    'mobile_no' => $request->mobile_no,
                    'staff_id' => $staff->id
                ]);

                return redirect()->route('listing.fee')->with('success','Fee Pay Successfully');
        }else{
            return redirect()->back()->with('success','Fee Pay Successfully');
        }
    }

    public function viewListFee()
    {
        $data = PayFee::all();
        return view('staff-panel.fee-listing',[
            'data' => $data,
            'i' => 1
        ]);
    }

    public function viewListStudentFiltered($class)
    {
        $students = Student::where('class',$class)->get();
        return view('staff-panel.student-listing-staff',[
            'students' => $students,
            'i' => 1,
            'class' => $class
        ]);
    }

    public function viewListStudent()
    {
        $staffId = Staff::where('user_id',Auth::user()->id)->pluck('id');
        $students = Student::where('created_by',$staffId)->get();

        return view('staff-panel.student-listing-staff',[
            'students' => $students,
            'i' => 1
        ]);
    }

    public function viewDashboard()
    {
        $studentCount = Student::all()->count();
        $paidFeeCount = PayFee::all()->count();
        return view('staff-panel.dashboard',[
            'studentCount' => $studentCount,
            'paidFeeCount' => $paidFeeCount
        ]);
    }
}
