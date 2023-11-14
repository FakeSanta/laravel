<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CarController extends Controller
{
    public function create(): View
    {
        return view('car.add');
    }

    public function index()
    {
        $cars = Car::all();
        return view('car', ['cars' => $cars]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string' , 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'immat' => ['required', 'string', 'regex:/^[A-Z]{2}-\d{3}-[A-Z]{2}$/', 'unique'],
            'price' => ['required', 'decimal'],
        ]);

        $car = Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'immat' => $request->immat,
            'price' => $request->price,
        ]);
    }
}
