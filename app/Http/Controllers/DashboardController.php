<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboard extends Controller
{
    //This method will show dashboard page for customer
    public function index(){
        return view('dashboard');
    }
}