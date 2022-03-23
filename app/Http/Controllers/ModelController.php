<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function getModels($id){
        $models = CarModel::where('car_mark_id', $id)->get();

        return $models;
    }
}
