<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMark extends Model
{
    use HasFactory;

    public function car_models(){
        return $this->hasMany(CarModel::class);
    }

    public function cars(){
        return $this->hasMany(Car::class);
    }
}
