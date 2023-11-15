<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Assets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    function index(): view
    {
        $isAdmin = auth()->user()->isAdmin();
        $properties = Property::with('assets')->get();
        return view('property.index', compact('properties'));
    }

    function create(){
        $assets = Assets::all();
        return view('property.create', compact('assets'));
    }

    function create_asset(){
        return view('property.asset.create');
    }

    function store_asset(Request $request){
        $request->validate([
            "name" => ['required', 'unique:assets,nom'],
        ]);

        $asset = Assets::create([
            "nom" => ucwords($request['name']),
        ]);

        return redirect()->route('property.index');
    }

    function store(Request $request){
        $request->validate([
            "type" => ['required', "in:appartement,house"],
            "city" => ['required', 'string'],
            "price" => ['required', 'numeric'],
            "surface" => ['required', 'numeric'],
            "room" => ['required', 'integer'],
            "assets" => ['array'],
            "picture" => ['image', 'mimes:jpeg,png,jpg,gif,jfif', 'max:2048'],
        ]);

        if($request->hasFile('picture')){
            $imagePath = $request->file('picture')->store('picture', 'public');
        }

        $property = Property::create([
            "type" => ucwords($request['type']),
            "city" => ucwords($request['city']),
            "surface" => $request['surface'],
            "price" => $request['price'],
            "room" => $request['room'],
            "picture" => $imagePath,
        ]);

        if(isset($request['assets'])){
            $property->assets()->attach($request['assets']);
        }

        return redirect()->route('property.index');
    }

    public function show($id): view
    {
        $property = Property::find($id);
        return view('property.show', ['property' => $property]);
    }


}
