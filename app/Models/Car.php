<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function car_mark(){
        return $this->belongsTo(CarMark::class);
    }

    public function car_model() {
        return $this->belongsTo(CarModel::class);
    }

    public function car_type() {
        return $this->belongsTo(CarType::class);
    }

    public function gas() {
        return $this->belongsTo(Gas::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function drivetrain() {
        return $this->belongsTo(Drivetrain::class);
    }

    public function car_images(){
        return $this->hasMany(CarImage::class);
    }
}
