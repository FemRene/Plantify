<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Room::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Room
    {
        $validated = $request->validate([
            'house' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'admin' => 'required|exists:users,id',
        ]);
        return Room::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Room::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): bool
    {
        $validated = $request->validate([
            'house' => 'sometimes|string|max:255',
            'room' => 'sometimes|string|max:255',
            'admin' => 'sometimes|exists:users,id',
        ]);
        return Room::findOrFail($id)->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): ?bool
    {
        return Room::findOrFail($id)->delete();
    }
}
