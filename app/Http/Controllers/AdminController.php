<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class AdminController extends DefaultController
{
    public function index(){
        return view('pages.admin.index');
    }


    public function cars(Request $request){
        $cars = new Car();

        if($request->has('keywords') && $request->get('keywords') != null){
            $keywords = $request->get('keywords');
            $cars = $cars->where(function ($query) use($keywords) {
                $query->orWhere('title', 'Like', '%' . $keywords . '%');
                $query->orWhere('description', 'Like', '%' . $keywords . '%');
            });
        }

        return view("pages.admin.cars.index", [
            "cars" => $cars->get()
        ]);
    }
}
