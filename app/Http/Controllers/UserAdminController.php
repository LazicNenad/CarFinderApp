<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserAdminController extends Controller
{

    public function index(Request $request)
    {
        $users = new User();

        if ($request->has('keywords') && $request->get('keywords') != null) {
            $keywords = $request->get('keywords');
            $users = $users->where('first_name', 'Like', '%' . $keywords . '%');
        }

        return view('pages.admin.users.index', [
            'users' => $users->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.users.create');
    }


    public function store(RegisterRequest $request)
    {

        try {
            $user = new User();

            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');
            $user->password = md5($request->get('password'));
            $user->location_id = $request->get('location');
            $user->role_id = $request->get('role');
            $user->photo = $request->file('photo')->getClientOriginalName();

            $user->save();
            $lastId = $user->id;

            if ($user) {
                Storage::makeDirectory('public/img/' . $lastId . '/profile/');
                $request->file('photo')->storeAs('public/img/' . $lastId . '/profile/', $request->file('photo')->getClientOriginalName());
                Log::info($request->ip() . ' registered new user via Admin dashboard');
                return redirect()->route('adminUser.index')->with('success', 'Successfully created new used!');
            }
        } catch (\Exception $exception) {
            Log::error($request->ip() . ' failed registraction via Admin dashboard! Message: ' . $exception);
            return redirect()->route('adminUser.index')->with('error', 'Error processing your data. ' . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::find($id);

        return view('pages.admin.users.edit', [
            'user' => $user
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->location_id = $request->get('location');
            $user->role_id = $request->get('role');

            $user->save();

            return redirect()->route('adminUser.index')->with('success', "Successfully updated user!");

        } catch (\Exception $exception) {
            Log::warning('Exception updating profile from admin dashboard! ' . $exception->getMessage());
            return redirect()->route('adminUser.index')->with('error', 'Error updating profile. ' . $exception->getMessage());
        }
    }


    public function destroy(Request $request,$id)
    {
        $user = User::find($id);
        try {
            User::destroy($user->id);

            Log::info($request->ip() . ' deleted user with id: ' . $user->id);
            return redirect()->route('adminUser.index')->with('success', 'Successfully deleted user!');

        } catch (\Exception $exception) {
            Log::info($request->ip() . ' tried unsuccessfully deleting user with id: ' . $user->id);
            return redirect()->route('adminUser.index')->with('error', 'Error deleting user! Cant delete user that has posted cars! ');
        }
    }
}
