<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class appcontroller extends Controller
{
    public function index(){
        return view('dashboard');
    }
}