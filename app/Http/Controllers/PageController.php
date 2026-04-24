<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
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
        $userId = Auth::id();
        $baseEventsQuery = Events::query()->where('user_id', $userId);
        $totalEvents = (clone $baseEventsQuery)->count();
        $publishedEvents = (clone $baseEventsQuery)->where('is_active', 1)->count();
        $draftEvents = (clone $baseEventsQuery)->where('is_active', 0)->count();
        $totalTickets = Tickets::query()->where('user_id', $userId)->count();
        $totalAttendees = Attendees::query()->where('user_id', $userId)->count();
        $totalRevenue = (float) Attendees::query()->where('user_id', $userId)->sum('amount');
        $nextEvent = (clone $baseEventsQuery)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->first();
        $recentEvents = Events::query()
            ->withCount(['ticket', 'attendees'])
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->take(5)
            ->get();
        $topEvents = Events::query()
            ->withCount(['ticket', 'attendees'])
            ->where('user_id', $userId)
            ->orderByDesc('attendees_count')
            ->orderByDesc('ticket_count')
            ->orderByDesc('id')
            ->take(3)
            ->get();
        $recentRegistrations = Attendees::query()
            ->with('event')
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('user.dashboard')->with([
            'metrics' => [
                'total_events' => $totalEvents,
                'published_events' => $publishedEvents,
                'draft_events' => $draftEvents,
                'total_tickets' => $totalTickets,
                'total_attendees' => $totalAttendees,
                'total_revenue' => $totalRevenue,
            ],
            'nextEvent' => $nextEvent,
            'recentEvents' => $recentEvents,
            'topEvents' => $topEvents,
            'recentRegistrations' => $recentRegistrations,
        ]);
    }

    public function renderEventDashboard(Request $request)
    {
        $userId = Auth::id();
        $search = trim((string) $request->input('q', ''));
        $status = (string) $request->input('status', '');
        $baseEventsQuery = Events::query()->where('user_id', $userId);
        $query = Events::query()
            ->withCount(['ticket', 'attendees'])
            ->where('user_id', $userId)
            ->orderByDesc('id');

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%')
                    ->orWhere('location_address', 'like', '%' . $search . '%')
                    ->orWhere('location_state', 'like', '%' . $search . '%');
            });
        }

        if ($status === 'live') {
            $query->where('is_active', 1);
        } elseif ($status === 'draft') {
            $query->where('is_active', 0);
        }

        $events = $query->get();

        return view('user.events.index')->with([
            'userEvents' => $events,
            'metrics' => [
                'total_events' => (clone $baseEventsQuery)->count(),
                'published_events' => (clone $baseEventsQuery)->where('is_active', 1)->count(),
                'draft_events' => (clone $baseEventsQuery)->where('is_active', 0)->count(),
                'total_attendees' => Attendees::query()->where('user_id', $userId)->count(),
            ],
            'filters' => [
                'q' => $search,
                'status' => $status,
            ],
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
        $event = Events::with('attendees')->where([
            'slug' => $slug,
            'user_id' => Auth::id(),
        ])->firstOrFail();
        $eventId = $event->id;
        $ticket = Tickets::where('event_id', $eventId)->get();
        $checked_in_attendees = Attendees::where([
            ['event_id', $eventId],
            ['checked_in', '=', 1],
        ])->count();      
        return view('user.events.events')->with([
            'event' => $event,
            'ticket' => $ticket,
            'checked_in_attendees' => $checked_in_attendees
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
            if($request->hasFile('bg_image_path') && !empty($event['bg_image_path'])){
                $oldImage = public_path('images/events/'.$event['bg_image_path']);
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
                if (!empty($event['bg_image_path'])) {
                    $oldImage = public_path('images/events/'.$event['bg_image_path']);
                    deleteFile($oldImage);
                }
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
