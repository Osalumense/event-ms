<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * Render Index page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('user.home');
    }

    public function renderHomePage()
    {
        return view('user.index');
    }

    public function renderAboutPage()
    {
        return view('user.about');
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

    /**
     * render create events page
     *
     * @return void
     */
    public function renderCreateEventPage()
    {
        return view('user.events.create');
    }

    /**
     * Create new event
     *
     * @param Request $request
     * @return void
     */
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

    public function renderEditEventPage($slug)
    {
        $event = Events::getEventBySlug($slug);
        $eventId = $event[0]['id'];
        $ticket = Tickets::getEventTickets($eventId);
        // dd($ticket);       
        return view('user.events.events')->with([
            'event' => $event[0],
            'ticket' => $ticket,
        ]);
    }

    /**
     * Publish event
     *
     * @param [int] $id
     * @return void
     */
    public function publishEvent($id)
    {
        $event = Events::get($id);
        if ($event instanceof Events) {
            try{
                $event->is_active = 1;
                $publishEvent = $event->save();
                if($publishEvent) {
                    return response()->json([
                        'code' => 200,
                        'msg' => 'Event published'
                    ]);
                }
            }
            catch (\Exception $exception){
                return response()->json([
                    'code' => 400,
                    'msg' => 'An error occured! please try again'
                ]);
            }
        }
    }

    public function updateEvent(Request $request)
    {
        $id = $request->input('id');
        $event = Events::get($id);
        $validation = Validator::make($request->all(), $event->rules());
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            if($request->hasFile('file')){
                $oldImage = '/images/events/'.$event['bg_image_path'];
                deleteFile($oldImage);
            }
            $event->edit();
            $slug = $event->slug;
            return redirect('/events/'.$slug)->with('success', 'Event updated successfully');
        }
    }

    /**
     * Delete an event
     *
     * @param [type] $id
     * @return void
     */
    public function deleteEvent($id)
    {
        try {
            DB::beginTransaction();
            $event = Events::get($id);
            if ($event instanceof Events) {
                $oldImage = app_path().'/images/events/'.$event['bg_image_path'];
                deleteFile($oldImage);
                $query = $event->delete();
                DB::commit();
                if ($query) {
                    return response()->json([
                        'code' => 200,
                        'msg' => 'Event deleted'
                    ]);
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 400,
                'msg' => 'An error occured! please try again'
            ]);
        }
    }

    public function saveTicketDetails(Request $request)
    {
        $ticket = new Tickets();
        $validation = Validator::make($request->all(), $ticket->rules());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'msg' => $validation->errors()->first()
            ]);
        }
        else {
            $ticket->edit();
            return response()->json([
                'code' => 200,
                'msg' => 'Ticket created successfully'
            ]);
        }
    }

    public function renderFaqPage()
    {
        return view('user.faq');
    }

    /**
     * Delete a ticket
     *
     * @param [type] $id
     * @return void
     */
    public function deleteTicket($id)
    {
        try {
            DB::beginTransaction();
            $ticket = Tickets::get($id);
            if ($ticket instanceof Tickets) {
                $query = $ticket->delete();
                DB::commit();
                if ($query) {
                    return response()->json([
                        'code' => 200,
                        'msg' => 'Ticket deleted'
                    ]);
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 400,
                'msg' => 'An error occured! please try again'
            ]);
        }
    }

    public function getTicketDetails(Request $request)
    {
        $id = $request->segment(3);
        $ticket = Tickets::get($id);
        logger('Id >>> ' . $id . 'ticket >> ' . $ticket);
        return response()->json([
            'ticket' => $ticket
        ]);
    }

    /**
     * Update a ticket
     */
    public function updateTicket(Request $request)
    {
        $id = $request->input('id');
        $ticket = Tickets::get($id);
        $validation = Validator::make($request->all(), [
            'title' => 'required|max:255|string',
            'price' => 'required|numeric',
            'quantity_available' => 'required|numeric',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'msg' =>  $validation->errors()->first()
            ]);
        }
        else {
            $ticket = Tickets::get($id);
            $ticket->edit();
            return response()->json([
                'code' => 200,
                'msg' => 'Ticket updated successfully'
            ]);
        }
    }
}
