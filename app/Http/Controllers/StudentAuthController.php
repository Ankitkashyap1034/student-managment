<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class StudentAuthController extends Controller
{
    public function viewStudentLogin()
    {
        return view('pages.authenticat-pages.student-login');
    }

    // function for login student
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
             'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, manually create a session
            $request->session()->regenerate();

            // Optionally, you can store additional information in the session
            // $request->session();
            dd(Auth::user());
            return redirect()->route('dashboard'); // Redirect to the dashboard or any other page
        }

        // Student::where('email',$request->email)->where('password',$request->password);
    }
}
