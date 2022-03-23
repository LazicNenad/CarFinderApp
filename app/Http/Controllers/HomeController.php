<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends DefaultController
{
    public function index()
    {
        return view('pages.car_finder_home');
    }
}
