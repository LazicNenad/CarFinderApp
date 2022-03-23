<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Image;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.users.index');
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $image = null;
        try {
            if ($request->file('profile_picture') != null) {
                $image = $request->file('profile_picture');
                $image->storeAs('public/img/' . $user->id . '/profile/', $image->getClientOriginalName());
            }


            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            if($image){
            $user->photo = $image->getClientOriginalName();
            }
            $user->save();

            $request->session()->put('user', $user);
            return redirect()->route('users.index')->with('success', "Successfully updated profile!");

        } catch (\Exception $exception) {
            Log::warning('User updating exception! ' . $exception->getMessage());
            return redirect()->route('users.index')->with('error', 'Error updating your profile');
        }

    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        $currentPasswordDatabase = $user->password;

        $current = md5($request->get('current_password'));
        $new = md5($request->get('new_password'));
        $newRepeat = md5($request->get('new_password_repeat'));

//        dd($current . ' ' . $new);

        if($currentPasswordDatabase != $current){
            return redirect()->route('users.index')->with('error', 'Current password doesnt match with actual one');
        }
        if($new !== $newRepeat){
            return redirect()->route('users.index')->with('error', 'Passwords doesnt match');
        }

        try {
            $user->password = $new;
            $user->save();

            return redirect()->route('users.index')->with('success', 'Password successfully updated!');
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
