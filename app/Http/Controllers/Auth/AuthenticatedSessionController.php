<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        // $data = [
        //     'body' => 'Welcome to SmartPay',
        //     'title' => 'Login Notification',
        //     'Name' => name(),
        //     'Email'=> emailAddress(),
        //     'EmailType' => "login"
        // ];
        // sendEmailNotification($data);
        // dd(inactive());
        if(inactive() == 1) {
            $notification = array(
                'message' => 'Please reset your password',
                'alert-type' => 'info'
            );
            return redirect('/user/reset_password')->with($notification);
        } else if (inactive() == 2){
            $notification = array(
                'message' => 'You do no longer have access to this system, contact ICT for more detail',
                'alert-type' => 'info'
            );
            return redirect('/logout')->with($notification);
        }else {
            $notification = array(
                'message' => 'Admin Login Successfully',
                'alert-type' => 'info'
            );
           return redirect('/dashboard')->with($notification);
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
