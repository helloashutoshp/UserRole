<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function logout()
    {
        $admin = Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }
}
