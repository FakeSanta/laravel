<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PropertyController;
use App\Models\User;
use App\Models\Car;
use App\Models\Assets;
use App\Models\Property;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    //      PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //      CAR ROUTES
    Route::get('/car', [CarController::class, 'index'])->name('car');
    Route::get('/car/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/car/store', [CarController::class, 'store'])->name('car.store');
    Route::get('/car/edit/{id}', [CarController::class, 'edit'])->name('car.edit');
    Route::post('/car/update/{id}', [CarController::class, 'update'])->name('car.update');
    Route::post('/car/delete/{id}', [CarController::class, 'delete'])->name('car.delete');

    //      PROPERTY ROUTES
    Route::get('/property', [PropertyController::class, 'index'])->name('property.index');
    Route::get('/property/create', [PropertyController::class, 'create'])->name('property.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/property/asset/create', [PropertyController::class, 'create_asset'])->name('property.asset.create');
    Route::post('/property/asset/store', [PropertyController::class, 'store_asset'])->name('property.asset.store');
    Route::get('/property/show/{id}', [PropertyController::class, 'show'])->name('property.show');
    Route::get('/property/agency/create', [PropertyController::class, 'create_agency'])->name('property.agency.create');
    Route::post('/property/agency/store', [PropertyController::class, 'store_agency'])->name('property.agency.store');


});

require __DIR__.'/auth.php';
