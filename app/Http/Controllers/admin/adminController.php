<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $admin = Auth::guard('admin')->user();
                if ($admin->role_id == 5) {
                    return redirect()->route('admin-dashboard');
                } else {
                    $admin = Auth::guard('admin')->logout();
                    return redirect()->route('admin-login')->with('error', 'You are not authorize');
                }
            } else {
                return redirect()->route('admin-login')->with('error', 'Invalid email or password');
            }
        } else {
            return redirect()->route('admin-login')->withErrors($validator)->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        $admin = Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }
}
