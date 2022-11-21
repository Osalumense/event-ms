<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Events;
use App\Models\User;
use App\Models\Tickets;

class EventController extends Controller
{
    //
    /**
     * Get public event details
     *
     * @param [string] $slug
     * @return void
     */
    public function renderEventPage($slug)
    {
        $getEvent = Events::getActiveEventBySlug($slug);
        $event = count($getEvent) > 0 ? $getEvent[0] : [];
        if(count($event) > 1){
            $getUser = User::get($event['user_id']);
        };
        $user = count($getEvent) > 0 ? $getUser : [];
        return view('user.events.public_events')->with([
            'event' => $event,
            'user' => $user
        ]);
    }

    public function renderEventRegistrationPage($slug)
    {
        $getEvent = Events::getActiveEventBySlug($slug);
        $event = count($getEvent) > 0 ? $getEvent[0] : [];
        $ticket = Tickets::getEventTicketsByEventIdAndUserId($event['id'], $event['account_id']);
        if(count($event) > 1){
            $getUser = User::get($event['user_id']);
        };
        $user = count($getEvent) > 0 ? $getUser : [];
        return view('user.events.register')->with([
            'event' => $event,
            'user' => $user,
            'ticket' => $ticket
        ]);
    }
}
