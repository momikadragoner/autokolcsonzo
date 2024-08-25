<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Car;


class ReservationController extends Controller
{

    public function search(Request $request) {

        $overlapping_reservations = DB::table('reservations')
        ->whereBetween('reservations.date_begin', [date($request->start), date($request->end)])
        ->orWhereBetween('reservations.date_end', [date($request->start), date($request->end)])
        ->select('car_id')
        ->distinct();

        $free_cars = DB::table('cars')
        ->where('cars.active', 1)
        ->whereNotIn('id', $overlapping_reservations)
        ->select('cars.*')
        ->get();

        return view('cars.index', [
            'cars' => $free_cars,
            'begin' => $request->begin,
            'end' => $request->end,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reservations.index', [
            'reservations' => Reservation::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id, Request $request)
    {
        $car = Car::findOrFail($id);
        $begin = strtotime($request->begin);
        $end = strtotime($request->end);
        $days= round(($end - $begin) / (60 * 60 * 24));
        return view('reservations.create', [
            'id' => $id,
            'car' => $car,
            'end' => $request->end,
            'begin' => $request->begin,
            'days' => $days,
            'price' => $days * $car->price,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):  RedirectResponse
    {
        $validated = $request->validate([
            'car_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'date_begin' => 'required|date',
            'date_end' => 'required|date',
            'days_reserved' => 'required|integer',
            'total_price' => 'required|integer',
        ]);

        Car::findOrFail($request->car_id)->reservations()->create($validated);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
