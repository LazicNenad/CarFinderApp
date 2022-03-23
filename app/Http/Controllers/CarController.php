<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\Location;
use App\Models\User;
use http\Message;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Image;

class CarController extends Controller
{
    public function __construct(){
        $this->middleware('edit')->only('edit');
    }

    public function index(Request $request)
    {
        $cars = new Car();

        if ($request->has('location') && $request->get('location') != null) {
            $location = $request->get('location');
            $cars = $cars->whereHas('user', function ($query) use($location) {
                return $query->where('location_id', $location);
            });
        }

        if ($request->has('carType')) {
            $carTypes = $request->get('carType');

            $cars = $cars->whereIn('car_type_id', $carTypes);
        };

        if ($request->has('yearFrom')) {
            $cars = $cars->whereBetween('year', [$request->get('yearFrom') ? $request->get('yearFrom') : Car::min('year'), $request->get('yearTo') ? $request->get('yearTo') : Car::max('year')]);
        }

        if ($request->has('condition')) {
            $cars = $cars->where('new', $request->get('condition'));
        }

        if ($request->has('mark')) {
            if ($request->get('mark') !== '0') {
                $cars = $cars->where('car_mark_id', '=', $request->get('mark'));
            }
        }

        if ($request->has('model')) {
            if ($request->get('model') !== '0') {
                $cars = $cars->where('car_model_id', '=', $request->get('model'));
            }
        }

        if ($request->has('priceFrom')) {
            if ($request->get('priceFrom') !== null) {
                $cars = $cars->where('price', '>=', intval($request->get('priceFrom')));
                $cars = $cars->where('price', '<=', intval($request->get('priceTo') !== null ? $request->get('priceTo') : '1500000'));
            };
        }

        if ($request->has('drivetrain')) {
            $drivetrains = $request->get('drivetrain');

            $cars = $cars->whereIn('drivetrain_id', $drivetrains);
        }

        if ($request->has('gas')) {
            $gases = $request->get('gas');

            $cars = $cars->whereIn('gas_id', $gases);
        }

        if ($request->has('mileageFrom')) {
            if ($request->get('mileageFrom') !== null) {
                $cars = $cars->where('mileage', '>=', intval($request->get('mileageFrom')));
                $cars = $cars->where('price', '<=', intval($request->get('mileageTo') !== null ? $request->get('mileageTo') : '15000000'));
            };
        }

        if ($request->has('transmission')) {
            $transmissions = $request->get('transmission');
            $cars = $cars->whereIn('transmission', $transmissions);
        }

        if ($request->has('sort')) {
            $order = $request->get('sort');

            if ($order == 'newest') {
                $cars = $cars->orderBy('year', 'desc');
            }
            if ($order == 'lth') {
                $cars = $cars->orderBy('price', 'asc');
            }

            if ($order == 'htl') {
                $cars = $cars->orderBy('price', 'desc');
            }
        }


        $cars = $cars->paginate(6);

        $totalOffers = Car::count();


        return view('pages.cars.index', [
            "totalOffers" => $totalOffers,
            "cars" => $cars
        ]);
    }


    public function create()
    {
        return view('pages.cars.create');
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
            return redirect()->route('cars.index')->with('success', "Successfully inserted car!");
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error('Error creating new car. Message: ' . $ex);
            return redirect()->back()->with('error', 'Failed to create entity. Please make sure you entered all fields.');
        }
    }


    public function show($id)
    {
        $car = Car::find($id);

        return view('pages.cars.show', [
            'car' => $car
        ]);
    }


    public function edit(Request $request, $id)
    {
        $carToEdit = Car::find($id);

        return view('pages.cars.edit', [
            'car' => $carToEdit
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
            $car->user_id = $request->session()->get('user')->id;
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

                    $image2->resize(300, 200)->save(public_path('assets/img/resized/' . $request->session()->get('user')->id . '_resized_' . $fileToUpload));

                    $image->storeAs('public/img/' . $request->session()->get('user')->id . '/', $fileToUpload);

                    $carImage->image = $fileToUpload;
                    $carImage->car_id = $id;

                    $carImage->save();
                }
            }
            DB::commit();
            Log::info($request->ip() . ' updated his car: ' . $id . ' - id of the updated entity');
            return redirect()->route('cars.index')->with('success', "Successfully updated your car!");
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error('Error updating entity. Message: ' . $ex);
        }
    }


    public function destroy(Request $request, $id)
    {
        if ($request->hasHeader('Accept') && $request->header('Accept') == 'application/json') {
            $itemToDelete = Car::find($id);
            $carImagesToDelete = CarImage::where('car_id', $itemToDelete->id)->get();
            try {
                foreach ($carImagesToDelete as $deleteOne) {
                    CarImage::destroy($deleteOne->id);
//                    if(File::exists(public_path('storage/img/' . $itemToDelete->user->id . '/' . $deleteOne->image))){
//                        File::delete(public_path('storage/img/' . $itemToDelete->user->id . '/' . $deleteOne->image));
//                    }
                }
                Car::destroy($itemToDelete->id);
                Log::info($request->ip() . ' deleted his entity(car)');
                return ["Message" => "Succesfully deleted!"];
            } catch (\Exception $ex) {
                Log::error('Error deleting car with his all photos from database. Exception message: ' . $ex);
                return ["ErrorMessage", "Error deleting your item" . $ex];
            }
        } else {
            $itemToDelete = Car::find($id);
            $carImagesToDelete = CarImage::where('car_id', $itemToDelete->id)->get();
            try {
                foreach ($carImagesToDelete as $deleteOne) {
                    CarImage::destroy($deleteOne->id);
                }
                Car::destroy($itemToDelete->id);
//                if(File::exists(public_path('storage/img/' . $itemToDelete->user->id . '/' . $deleteOne->image))){
//                    File::delete(public_path('storage/img/' . $itemToDelete->user->id . '/' . $deleteOne->image));
//                }
                Log::info($request->ip() . ' deleted his entity(car)');
                return redirect()->route('users.index')->with('success', 'Successfully deleted entity');
            } catch (\Exception $ex) {
                Log::error('Error deleting car with his all photos from database. Exception message: ' . $ex);
                return redirect()->route('users.index')->with('error', 'Error deleting your entity" . $ex');
            }
        }

    }

    public function deleteImage(Request $request, $id){
        try {
            CarImage::find($id)->delete();
            return response()->json(["success" => "Deleted image from server"]);
        }catch (\Exception $exception){
            return response()->json(["error" => "Error with server " . $exception]);
        }
    }
}
