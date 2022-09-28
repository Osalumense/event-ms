<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
        /**
     * Render Index page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return redirect('/login');
    }

    public function renderHomePage()
    {
        return view('user.index');
    }

    public function renderOrganizerDashboard()
    {
        $userId = Auth::user()->id;
        $totalEvents = Events::getUserEventCount($userId);
        // $recently_added_users = User::getRecentlyAdded();
        $recently_added_events = Events::getRecentlyCreatedEvents();
        return view('user.dashboard')->with([
            'total_events'=> $totalEvents,
            'recently_added_events' => $recently_added_events,
        ]);
    }

    public function renderEventDashboard()
    {
        $events = Events::getUserEvents();
        return view('user.events.index')->with([
            'userEvents' => $events
        ]);
    }

    public function saveEventDetails(Request $request)
    {
        $event = new Events();
        $validation = Validator::make($request->all(), $event->rules());
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $event->edit();
            return redirect('/events')->with('success', 'New event created successfully');
        }
    }

    // public function getEventDetails
}
