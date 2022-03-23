<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationAdminController extends Controller
{

    public function index(Request $request)
    {
        $locations = new Location();

        if($request->has('keywords') && $request->get('keywords') !== null) {
            $keywords =  $request->get('keywords');
            $locations = $locations->where('location', 'like', '%' . $keywords . '%');
        }

        return  view('pages.admin.locations.index', [
            'locations' => $locations->get()
        ]);
    }


    public function create()
    {
        return  view('pages.admin.locations.create');
    }

    public function store(LocationRequest $request)
    {
        try {
            $location = new Location();

            $location->location = $request->get('location');

            $location->save();

            Log::info($request->ip() . ' added new location');
            return redirect()->route('location.index')->with('success', 'Successfully added new location');
        } catch (\Exception $exception){
            Log::info($request->ip() . ' Error adding new location!');
            return redirect()->route('location.index')->with('error', 'Error inserting new location! ' . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $location = Location::find($id);

        return view('pages.admin.locations.edit', [
            'location' => $location
        ]);
    }


    public function update(LocationRequest $request, $id)
    {
        try {
            $location = Location::find($id);

            $location->location = $request->get('location');

            $location->save();

            Log::info($request->ip() . ' updated location with id: ' . $id);
            return redirect()->route('location.index')->with('success', 'Successfully updated  location');
        } catch (\Exception $exception){
            Log::info($request->ip() . ' Error updating location!');
            return redirect()->route('location.index')->with('error', 'Error updating existing location! ' . $exception->getMessage());
        }
    }


    public function destroy(Request $request,$id)
    {
        try {
            Location::destroy($id);

            Log::info($request->ip() . ' deleted location ');
            return redirect()->route('location.index')->with('success', 'Successfully deleted user!');

        }catch (\Exception $exception){
            Log::info($request->ip() . ' tried unsuccessfully deleting location with id: ');
            return redirect()->route('location.index')->with('error', 'Error deleting location! ' . $exception->getMessage());
        }
    }
}
