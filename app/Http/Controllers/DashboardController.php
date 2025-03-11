<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.pelapor');
    }
    public function admin() {
        return view('dashboard.admin');
    }
    public function upt() {
        return view('dashboard.upt');
    }
}
