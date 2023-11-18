<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Property;
use App\Models\Assets;
use App\Models\User;
use App\Services\NominatimService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    protected $nominatimService;

    public function __construct(NominatimService $nominatimService)
    {
        $this->nominatimService = $nominatimService;
    }

    function index(): view
    {
        $isAdmin = auth()->user()->isAdmin();
        $agencies = Agency::all();
        $properties = Property::with('assets')->get();

        return view('property.index', compact('properties', 'agencies'));
    }

    function delete($id)
    {
        $property = Property::findOrFail($id)->delete();
        return redirect()->route('property.index');
    }    

    function create(){
        $assets = Assets::all();
        $agencies = Agency::all();
        return view('property.create', compact('assets', 'agencies'));
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
            "agency" => ["required", 'integer'],
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
            "agency_id" => $request['agency']
        ]);

        if(isset($request['assets'])){
            $property->assets()->attach($request['assets']);
        }

        return redirect()->route('property.index');
    }

    public function show($id): view
    {
        $property = Property::find($id);
        $city = $property->city;
        $geocodeResult = $this->nominatimService->geocode($city);
        return view('property.show', ['property' => $property, 'geocodeResult' => $geocodeResult]);
    }

    function create_agency(){
        return view('property.agency.create');
    }

    function store_agency(Request $request){
        $request->validate([
            'name'=> ['required', 'string'],
        ]);

        $agency =  Agency::create([
            "name" => ucwords($request['name']),
        ]);

        return redirect()->route('property.index');
    }
}
