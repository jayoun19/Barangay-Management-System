<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        // Kukunin ang lahat ng events mula sa database
        // Para sa ngayon, gagamit muna tayo ng sample data na format ng FullCalendar
        $events = [
            [
                'title' => 'Community Health Drive',
                'start' => now()->addDays(3)->format('Y-m-d'),
                'className' => 'bg-blue-500 text-white p-1 rounded',
            ],
            [
                'title' => 'Brgy Assembly',
                'start' => now()->addDays(10)->format('Y-m-d'),
                'className' => 'bg-rose-500 text-white p-1 rounded',
            ]
        ];

        return view('calendar.index', compact('events'));
    }

    public function create()
    {
        return view('calendar.create');
    }

    public function view()
    {
        $calendarEvents = Event::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'date' => $event->date->format('Y-m-d'),
                'location' => $event->location,
                'description' => $event->description,
            ];
        });
        $currentYear = now()->year;
        return view('calendar.calendar', compact('calendarEvents', 'currentYear'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Event::create($request->only(['title', 'date', 'location', 'description']));

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Event added successfully!']);
        }

        return redirect()->route('calendar.index')->with('success', 'Event added successfully!');
    }
}