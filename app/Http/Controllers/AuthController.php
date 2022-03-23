<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterInModalRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where([
            ['email', '=', $request->get('email')],
            ['password', '=', md5($request->get('password'))]
        ])->first();

        if ($user !== null) {
            $request->session()->put('user', $user);
            return redirect()->route('cars.index');
        } else {
            Session::flash('#signup-modal');
            return redirect()->back();
        }
    }

    public function register(RegisterInModalRequest $request)
    {
        try {
            $user = new User();

            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');
            $user->password = md5($request->get('password'));
            $user->location_id = $request->get('location');
            $user->role_id = 2;

            $user->save();
            $lastId = $user->id;

            if ($user) {
                Storage::makeDirectory('public/img/' . $lastId . '/profile/');
                $user = User::find($user->id);
                $request->session()->put('user', $user);
                Log::info($request->ip() . ' registered to our application!');
                return redirect()->route('cars.index');
            }
        }catch (\Exception $exception){
            Log::error($request->ip() . ' failed registraction. Message: ' . $exception);
            return redirect()->route('home');
        }

    }

    public function signout(Request $request)
    {
        $request->session()->forget('user');

        return redirect()->route('home');
    }
}
