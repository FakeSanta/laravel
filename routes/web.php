<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Models\User;
use App\Models\Car;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    //$users = User::where("name","Aurelien")->update(['email'=>'aurelienfevrier08@gmail.com']);
    $users = User::get();
    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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


});

require __DIR__.'/auth.php';
