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
        return view('car.create');
    }

    public function index()
    {
        $cars = Car::all();
        return view('car', ['cars' => $cars]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'immat' => ['required', 'string', 'regex:/^[A-Z]{2}-\d{3}-[A-Z]{2}$/i', 'unique:cars,immat'], // Ajout de 'unique' pour vérifier l'unicité
            'price' => ['required', 'numeric'], // Utilisation de 'numeric' pour valider le prix comme un nombre
        ]);

        $car = Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'immat' => strtoupper($request->immat), // Convertir l'immatriculation en majuscules
            'price' => $request->price,
        ]);

        if (!$car) {
            // Affichez des messages d'erreur ou effectuez des actions en conséquence
            dd('Erreur lors de l\'ajout à la base de données');
        }
        return redirect()->route('car'); // Assurez-vous que la route 'car.index' existe
    }

    public function edit($id): View
    {
        $car = Car::find($id);
        return view('car.edit', ['car'=>$car]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'immat' => ['required', 'string', 'regex:/^[A-Z]{2}-\d{3}-[A-Z]{2}$/i'], // Ajout de 'unique' pour vérifier l'unicité
            'price' => ['required', 'numeric'], // Utilisation de 'numeric' pour valider le prix comme un nombre
        ]);

        $car = Car::find($id);

        $car->update([
            'name'=> $request->name,
            'brand'=> $request->brand,
            'immat'=> strtoupper($request->immat),
            'price'=> $request->price,
        ]);

        return redirect()->route('car');
    }

    public function delete($id)
    {
        $car = Car::find($id);

        if ($car) {
            $car->delete();
            return redirect()->route('car')->with('success', 'Car deleted successfully');
        } else {
            return redirect()->route('car')->with('error', 'Car not found');
        }
    }


}
