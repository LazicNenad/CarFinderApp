<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    public function car_mark(){
        return $this->belongsTo(CarMark::class);
    }

    public function cars(){
        return $this->hasMany(Car::class);
    }
}
