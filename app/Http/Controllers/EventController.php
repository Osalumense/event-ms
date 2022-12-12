<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Events;
use App\Models\User;
use App\Models\Tickets;
use App\Models\Attendees;

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

    public function registerAttendee(Request $request)
    {
        $attendee = new Attendees();
        $validation = Validator::make($request->all(), $attendee->rules());
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $attendee->edit();
            return redirect()->back()->with('success', 'you have successfully registered for this event');
        }
    }
}
