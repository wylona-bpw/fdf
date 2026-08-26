<?php
namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::published()->upcoming()->get();
        $pastEvents = Event::published()->past()->paginate(9, ['*'], 'past_page');

        return view('pages.events.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function show(string $slug)
    {
        $event = Event::published()->where('slug', $slug)->firstOrFail();

        return view('pages.events.show', compact('event'));
    }
}
