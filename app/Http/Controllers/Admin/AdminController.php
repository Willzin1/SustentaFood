<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function dashboard(): View
    {
        return view('pages.admin.dashboard');
    }
}
