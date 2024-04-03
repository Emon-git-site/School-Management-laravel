<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect()->route('teacher.dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect()->route('student.dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect()->route('parent.dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if (Auth::user()->user_type == 1) {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect()->route('teacher.dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect()->route('student.dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect()->route('parent.dashboard');
            }
        } else {
            toastr()->adderror('Please Enter Correct Email and Password. ');
            return redirect()->back();
        }
    }

    public function forgetPasswordShow()
    {
        return view('auth.forget');
    }

    public function forgetPasswordPerform(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            toastr()->addSuccess('Please Check your email and reset your password', 'Success', [
                'timeOut' => 5000,
                'closeButton' => true,
            ]);

            return redirect()->back();
        } else {
            toastr()->adderror('Email not found in the system ');
            return redirect()->back();
        }
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }
    }
    public function PostReset($token, Request $request)
    {
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            toastr()->addsuccess('Password Successfully Reset');
            return redirect()->route('login.show');
        }
        else
        {
            toastr()->adderror('Password and Conform Password does not match. ');
            return redirect()->back();
        }
    }

    public function AuthLogout()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
