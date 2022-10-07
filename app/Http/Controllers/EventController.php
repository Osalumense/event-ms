<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Events;
use App\Models\User;

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
        // dd($user);
        return view('user.events.public_events')->with([
            'event' => $event,
            'user' => $user
        ]);
    }
}
