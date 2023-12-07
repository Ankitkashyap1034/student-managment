<?php

namespace App\Http\Controllers;
use App\Models\Staff;
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

                return redirect()->route('home.staff');
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
            return view('staff-panel.fee-pay');
        }
    }
}
