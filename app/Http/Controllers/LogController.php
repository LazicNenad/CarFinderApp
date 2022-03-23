<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        return view("pages.admin.logs.index");
    }
}
