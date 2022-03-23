<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Image;

class CarAdminController extends DefaultController
{

    public function index(Request $request)
    {
        $cars = new Car();

        if($request->has('keywords') && $request->get('keywords') != null){
            $keywords = $request->get('keywords');
            $cars = $cars->where(function ($query) use($keywords) {
                $query->orWhere('title', 'Like', '%' . $keywords . '%');
                $query->orWhere('description', 'Like', '%' . $keywords . '%');
            });
            $cars = $cars->whereHas('car_mark', function ($query) use($keywords) {
               return $query->orWhere('mark', 'Like', '%' . $keywords . '%');
            });
        }

        return view("pages.admin.cars.index", [
            "cars" => $cars->paginate(2)
        ]);
    }


    public function create()
    {
        return view('pages.admin.cars.create');
    }


    public function store(CarRequest $request)
    {
        try {
            DB::beginTransaction();
            $car = new Car();

            $car->title = $request->get('title');
            $car->car_mark_id = $request->get('car_mark');
            $car->car_model_id = $request->get('model');
            $car->car_type_id = $request->get('car_type');
            $car->gas_id = $request->get('gas');
            $car->user_id = $request->session()->get('user')->id;
            $car->drivetrain_id = $request->get('drivetrain');
            $car->description = $request->get('description');
            $car->year = $request->get('year');
            $car->new = $request->get('condition');
            $car->transmission = $request->get('transmission');
            $car->mileage = $request->get('mileage');
            $car->price = $request->get('price');

            $car->save();
            $lastId = $car->id;

            if ($request->file('files') != null) {
                foreach ($request->file('files') as $file) {
                    $carImage = new CarImage();
                    $image = $file;

                    $originalName = $image->getClientOriginalName();

                    $fileToUpload = $originalName;

                    $image2 = Image::make($image->getRealPath());

                    $image2->resize(1000, 500)->save(public_path('assets/img/resized/' . $request->session()->get('user')->id . '_resized_' . $fileToUpload));

                    $image->storeAs('public/img/' . $request->session()->get('user')->id . '/', $fileToUpload);

                    $carImage->image = $fileToUpload;
                    $carImage->car_id = $lastId;

                    $carImage->save();
                }
            }
            DB::commit();
            Log::info($request->ip() . ' uploaded new entity(car): ' . $lastId . ' - id of new entity');
            return redirect()->route('adminCar.index')->with('success', "Successfully inserted car!");
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error('Error creating new car. Message: ' . $ex);
            return redirect()->route('adminCar.index')->with('error', "Error inserting car! Message: " . $ex->getMessage());
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $car = Car::find($id);

        return view('pages.admin.cars.edit', [
            'car' => $car
        ]);
    }


    public function update(CarUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $car = Car::find($id);

            $car->title = $request->get('title');
            $car->car_mark_id = $request->get('car_mark');
            $car->car_model_id = $request->get('model');
            $car->car_type_id = $request->get('car_type');
            $car->gas_id = $request->get('gas');
            $car->drivetrain_id = $request->get('drivetrain');
            $car->description = $request->get('description');
            $car->year = $request->get('year');
            $car->new = $request->get('condition');
            $car->transmission = $request->get('transmission');
            $car->mileage = $request->get('mileage');
            $car->price = $request->get('price');

            $car->save();

            if ($request->file('files') != null) {
                foreach ($request->file('files') as $file) {
                    $carImage = new CarImage();
                    $image = $file;

                    $originalName = $image->getClientOriginalName();

                    $fileToUpload = $originalName;

                    $image2 = Image::make($image->getRealPath());

                    $image2->resize(1000, 500)->save(public_path('assets/img/resized/' . $car->user_id . '_resized_' . $fileToUpload));

                    $image->storeAs('public/img/' . $car->user_id . '/', $fileToUpload);

                    $carImage->image = $fileToUpload;
                    $carImage->car_id = $id;

                    $carImage->save();
                }
            }
            DB::commit();
            Log::info($request->ip() . ' updated his car: ' . $id . ' - id of the updated entity');
            return redirect()->route('adminCar.index')->with('success', "Successfully updated car from admin dashboard!");
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error('Error updating entity. Message: ' . $ex);
            return redirect()->route('adminCar.index')->with('error', "Error updating car from admin dashboard! Message: " . $ex->getMessage() . ' Please contact manager to fix this problem.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
