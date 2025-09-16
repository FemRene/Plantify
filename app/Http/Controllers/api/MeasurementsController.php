<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Measurements;
use Illuminate\Http\Request;

class MeasurementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Measurements::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Measurements
    {
        $validated = $request->validate([
            'plant_id' => 'required',
            'humidity' => 'required',
            'temperature' => 'required',
            'light' => 'required',
            'water' => 'required',
        ]);
        return Measurements::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Measurements::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): bool
    {
        $validated = $request->validate([
            'plant_id' => 'sometimes|exists:Plants,id',
            'humidity' => 'sometimes|numeric',
            'temperature' => 'sometimes|numeric',
            'light' => 'sometimes|numeric',
            'water' => 'sometimes|numeric',
        ]);
        return Measurements::findOrFail($id)->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): ?bool
    {
        return Measurements::findOrFail($id)->delete();
    }
}
