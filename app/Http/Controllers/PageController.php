<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('user.dashboard');
    }

    public function renderEventDashboard()
    {
        return view('user.events.index');
    }
}
