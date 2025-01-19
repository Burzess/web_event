<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Talent;
use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Event::with('ticketCategories')
                        ->where('status', 'active')
                        ->get();
        $totalEvents = Event::count();
        $totalParticipants = Participant::count();
        $totalTalents = Talent::count();

        return view('pages.home', compact('events', 'totalEvents', 'totalParticipants', 'totalTalents'));
    }
}
