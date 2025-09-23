<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\Measurements;
use App\Models\Plant;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class DashboardController extends Controller
{
    public function index()
    {
        $avgMeasurements = DB::table('rooms')
            ->leftJoin('plants', 'plants.room_id', '=', 'rooms.id')
            ->leftJoin('measurements', 'measurements.plant_id', '=', 'plants.id')
            ->select(
                'rooms.id as room_id',
                'rooms.house',
                'rooms.room',
                DB::raw("datetime((strftime('%s', measurements.created_at) / 300) * 300, 'unixepoch') as time_slot"),
                DB::raw('AVG(measurements.humidity) as avg_humidity'),
                DB::raw('AVG(measurements.temperature) as avg_temperature'),
                DB::raw('AVG(measurements.light) as avg_light'),
                DB::raw('AVG(measurements.water) as avg_water')
            )
            ->groupBy('rooms.id', 'rooms.house', 'rooms.room', 'time_slot')
            ->orderBy('rooms.id')
            ->orderBy('time_slot')
            ->get();

        return view('layouts.dashboard.index', [
            'avgMeasurements' => $avgMeasurements,
        ]);
    }

    public function room($id)
    {
        $avgMeasurements = DB::table('rooms')
            ->leftJoin('plants', 'plants.room_id', '=', 'rooms.id')
            ->leftJoin('measurements', 'measurements.plant_id', '=', 'plants.id')
            ->select(
                'rooms.id as room_id',
                'rooms.house',
                'rooms.room',
                DB::raw("datetime((strftime('%s', measurements.created_at) / 300) * 300, 'unixepoch') as time_slot"),
                DB::raw('AVG(measurements.humidity) as avg_humidity'),
                DB::raw('AVG(measurements.temperature) as avg_temperature'),
                DB::raw('AVG(measurements.light) as avg_light'),
                DB::raw('AVG(measurements.water) as avg_water')
            )
            ->where('rooms.id', $id) // filter for the specific room
            ->groupBy('rooms.id', 'rooms.house', 'rooms.room', 'time_slot')
            ->orderBy('rooms.id')
            ->orderBy('time_slot')
            ->get();

        $room = Room::findOrFail($id);
        $plants = Plant::where('room_id', $id)->get();
        return view('layouts.dashboard.room', [
            'avgMeasurements' => $avgMeasurements,
            'room' => $room,
            'plants' => $plants,
        ]);
    }

    public function plant($id) {
        $avgMeasurements = DB::table('rooms')
            ->leftJoin('plants', 'plants.room_id', '=', 'rooms.id')
            ->leftJoin('measurements', 'measurements.plant_id', '=', 'plants.id')
            ->select(
                'rooms.id as room_id',
                'rooms.house',
                'rooms.room',
                'plants.id as plant_id',
                'plants.name as plant_name',
                DB::raw("datetime((strftime('%s', measurements.created_at) / 300) * 300, 'unixepoch') as time_slot"),
                DB::raw('AVG(measurements.humidity) as avg_humidity'),
                DB::raw('AVG(measurements.temperature) as avg_temperature'),
                DB::raw('AVG(measurements.light) as avg_light'),
                DB::raw('AVG(measurements.water) as avg_water')
            )
            ->where('plants.id', $id) // filter for the specific plant
            ->groupBy('rooms.id', 'rooms.house', 'rooms.room', 'plants.id', 'plants.name', 'time_slot')
            ->orderBy('time_slot')
            ->get();

        $plant = Plant::findOrFail($id);
        return view('layouts.dashboard.plant', [
            'plant' => $plant,
            'avgMeasurements' => $avgMeasurements,
        ]);
    }
}
