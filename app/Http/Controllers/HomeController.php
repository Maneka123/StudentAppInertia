<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        //return view('pages\home\index');
        return Inertia::render('Dashboard/index');
    }
}
