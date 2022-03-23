<?php

namespace App\Http\Middleware;

use App\Models\Car;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $carId = explode('/', $request->path())[1];
        $car = Car::find($carId);

        if($car->user_id !== $request->session()->get('user')->id){
            Log::warning($request->ip() . " tried editing car that he doesnt own !!");
            return redirect()->route('cars.index')->with("error", "You cant edit car that is not yours!");
        }

        return $next($request);


    }
}
