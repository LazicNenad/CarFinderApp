<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Car extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $used, $year, $name, $price, $location, $mileage, $transmission, $gas, $image, $description,  $title, $userId, $id;

    public function __construct($used, $year, $name, $price, $location, $mileage, $transmission, $gas, $image , $description, $userId, $title, $id)
    {
        $this->used = $used;
        $this->year = $year;
        $this->name = $name;
        $this->price = $price;
        $this->location = $location;
        $this->mileage = $mileage;
        $this->transmission = $transmission;
        $this->gas = $gas;
        $this->image = $image;
        $this->description = $description;
        $this->userId = $userId;
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.car');
    }
}
