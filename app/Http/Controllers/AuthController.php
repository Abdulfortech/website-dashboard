<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.signin');
    }

    public function showRegistrationForm()
    {
        return view('auth.signup');
    }

    public function signin(Request $request)
    {
        // Validation logic here
        if (Auth::attempt($request->only('username', 'password'))) {
            if(auth()->user()->status == 'Active')
            {
                $userLog = UserLogs::create([ 
                    'user_id' => auth()->user()->id,
                    'username' => $request->username,
                    'IPAddress' => $_SERVER['REMOTE_ADDR'],
                    'status' => 'Signed-In',
                ]);
                
                if(isset(auth()->user()->business_id))
                {
                    return redirect()->route('dashboard')->with('message', 'Signed In successsfully');
                }
                return redirect()->route('addBusiness')->with('message', 'Signed In successsfully');
            }
            else
            {
                return redirect()->route('showSignin')->with('message', 'You are not active');
            }
        }
            $userLog = UserLogs::create([ 
                'user_id' => 0,
                'username' => $request->username,
                'IPAddress' => $_SERVER['REMOTE_ADDR'],
                'status' => 'Failed',
            ]);
        // Handle failed login
        return redirect()->back()->withInput()->withErrors(['username' => 'Invalid credentials']);
    }

    public function signup(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'firstName' => ['required', 'min:4'],
            'lastName' => ['required', 'min:4'],
            'username' => 'required|unique:users',
            'userType' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        $credentials['status'] = 'Active';
        $credentials['password'] = bcrypt($credentials['password']);
        // dd($credentials);
        // Create a new user
        $user = User::create($credentials);

        // Log in the user
        Auth::login($user);
        $userLog = UserLogs::create([ 
            'user_id' => auth()->user()->id,
            'username' => $request->username,
            'IPAddress' => $_SERVER['REMOTE_ADDR'],
            'status' => 'Signed-In',
        ]);

        return redirect()->route('addBusiness')->with('message', 'Sign up In successsfully');

        // // Redirect to the user dashboard
        // return redirect()->route('dashboard')->with('message', 'You Sign-In successfully.');
    }


    public function logout()
    {
        $userLog = UserLogs::create([ 
            'user_id' => auth()->user()->id,
            'username' =>  auth()->user()->username,
            'IPAddress' => $_SERVER['REMOTE_ADDR'],
            'status' => 'Signed-Out',
        ]);
        Auth::logout();
        return redirect()->route('signin'); // Redirect to the login page after logout
    }

}
