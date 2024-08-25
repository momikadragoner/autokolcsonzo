<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

Route::get('/', function () {
    return view('index');
});

Route::resource('cars', CarController::class);
Route::post('reservations/search', [ReservationController::class, 'search']);
Route::get('cars/{id}/image', function ($id) {
    $car = Car::find($id);
    return response()->make($car->image, 200, array(
        'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($car->image)
    ));
});

Route::resource('reservations', ReservationController::class)->only(['index', 'store']);
Route::get('reservations/create/{id}', [ReservationController::class, 'create']);
