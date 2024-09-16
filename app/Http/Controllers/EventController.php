<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $event = Events::where([
            'slug' => $slug,
            'is_active' => 1,
        ])->first();

        $event = $event ? $event->toArray() : [];
        $user = !empty($event) ? optional(User::get($event['user_id']))->toArray() : [];

        return view('user.events.public_events')->with([
            'event' => $event,
            'user' => $user
        ]);
    }

    public function renderEventRegistrationPage($slug)
    {
        $event = Events::where([
            'slug' => $slug,
            'is_active' => 1,
        ])->first();

        $ticket = $event
            ? Tickets::where('event_id', $event->id)->orderBy('id', 'DESC')->get()->toArray()
            : [];
        $user = $event ? optional(User::get($event->user_id))->toArray() : [];

        return view('user.events.register')->with([
            'event' => $event ? $event->toArray() : [],
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

        $event = Events::where([
            'id' => $request->input('event_id'),
            'is_active' => 1,
        ])->first();

        if (!$event) {
            return redirect()->back()->with('error', 'This event is no longer available for registration.');
        }

        $ticket = null;
        $ticketId = $request->input('ticket_id');
        $eventHasTickets = Tickets::where('event_id', $event->id)->exists();

        if ($eventHasTickets && empty($ticketId)) {
            return redirect()->back()->with('error', 'Select a ticket before completing your registration.')->withInput();
        }

        if (!empty($ticketId)) {
            $ticket = Tickets::where([
                'id' => $ticketId,
                'event_id' => $event->id,
            ])->first();

            if (!$ticket) {
                return redirect()->back()->with('error', 'The selected ticket is invalid.')->withInput();
            }

            if (!is_null($ticket->quantity_available) && $ticket->quantity_sold >= $ticket->quantity_available) {
                return redirect()->back()->with('error', 'That ticket is sold out. Please choose another one.')->withInput();
            }
        }

        DB::transaction(function () use ($attendee, $event, $request, $ticket) {
            $attendee->forceFill([
                'event_id' => $event->id,
                'ticket_id' => optional($ticket)->id,
                'user_id' => $event->user_id,
                'account_id' => $event->account_id,
                'order_id' => random_int(100000, 999999999),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'amount' => $ticket ? $ticket->price : 0,
            ]);
            $attendee->save();

            if ($ticket) {
                $ticket->increment('quantity_sold');
            }
        });

        return redirect()->back()->with('success', 'You have successfully registered for this event.');
    }
}
