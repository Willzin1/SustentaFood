<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(): View
    {
        return view('index');
    }
}
