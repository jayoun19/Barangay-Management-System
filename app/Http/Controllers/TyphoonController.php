<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TyphoonController extends Controller
{
    public function index()
    {
        // Quezon City default
        $initialStatus = $this->generateStatus(14.6760, 121.0437);
        $monitoringRoute = route('typhoon.live');

        return view('typhoon.index', compact('initialStatus', 'monitoringRoute'));
    }

    public function live(Request $request)
    {
        $lat = $request->query('lat', 14.6760);
        $lon = $request->query('lon', 121.0437);
        
        return response()->json($this->generateStatus($lat, $lon));
    }

    private function generateStatus($lat, $lon): array
    {
        $now = now();
        $seed = crc32($now->format('YmdHi') . $lat . $lon);
        $weatherTypes = ['Light Rain', 'Cloudy', 'Overcast', 'Heavy Rain', 'Thunderstorm', 'Clear'];
        
        return [
            'location' => "Station ($lat, $lon)",
            'updated_at' => $now->format('h:i A'),
            'current_temperature' => 25 + ($seed % 7),
            'weather_description' => $weatherTypes[$seed % count($weatherTypes)],
            'wind_speed' => 10 + ($seed % 50),
            'humidity' => 60 + ($seed % 30),
            'rain_chance' => $seed % 100,
            'suggestion' => 'Live tracking active for your coordinates.',
        ];
    }
}