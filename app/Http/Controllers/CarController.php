<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\throwException;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cars.list', [
            'cars' => Car::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create', [
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable',
        ]);

        $file = $request->file('image');
        $contents = $file->openFile()->fread($file->getSize());
        $validated['image'] = $contents;

        Car::create($validated);

        return redirect(route('cars.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', [
            'car' => $car,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.create', [
            'edit' => true,
            'car' => $car,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car): RedirectResponse
    {
        // Gate::authorize('update', $car);

        $validated = $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'price' => 'required|integer',
            'description' => 'string|nullable',
            'image' => 'binary',
        ]);

        $car->update($validated);

        return redirect(route('cars.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): RedirectResponse
    {
        $car->update(['active' => 0]);
        return redirect(route('cars.index'));
    }
}
