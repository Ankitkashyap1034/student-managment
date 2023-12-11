<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Student;
use Auth;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    public function viewStudentLogin()
    {
        if (! Auth::user()) {
            return view('pages.authenticat-pages.student-login');
        } else {
            return redirect()->route('home.student');
        }
    }

    // function for login student
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = Student::where('email', $request->email)->first();
        if ($user) {
            if (Auth::attempt($credentials)) {
                // Authentication passed, manually create a session
                $request->session()->regenerate();

                return redirect()->route('home.student');
            } else {
                return redirect()->back()->with('login-faild', 'Login credentials are not correct');
            }
        } else {
            return redirect()->back()->with('email-faild', 'Login credentials are not correct');
        }

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.student')->with('logout-successfull', 'Log out Successfull');

    }
}
