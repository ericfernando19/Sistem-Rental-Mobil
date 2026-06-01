<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('images')->latest()->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('cars', 'public');
        }

        $car = Car::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                CarImage::create(['car_id' => $car->id, 'image' => $path]);
            }
        }

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(StoreCarRequest $request, Car $car)
    {
        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            if ($car->main_image) {
                Storage::disk('public')->delete($car->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('cars', 'public');
        }

        $car->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                CarImage::create(['car_id' => $car->id, 'image' => $path]);
            }
        }

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        if ($car->main_image) {
            Storage::disk('public')->delete($car->main_image);
        }
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil dihapus.');
    }

    public function deleteImage(CarImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
