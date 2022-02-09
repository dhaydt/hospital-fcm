<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Checkup;
use App\Models\Content;
use App\Models\Customer;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
        $pasien = Customer::orderby('created_at', 'DESC')->get();
        $checkup = Checkup::orderby('created_at', 'DESC')->get();
        $content = Content::orderby('created_at', 'DESC')->get();
        $admin = Admin::orderby('created_at', 'DESC')->get();
        session()->put('title', 'Dashboard');

        return view('admin-views.system.dashboard', compact('pasien', 'checkup', 'content', 'admin'));
    }
}
