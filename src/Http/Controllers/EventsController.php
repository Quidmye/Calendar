<?php

namespace Quidmye\Http\Controllers;

use Illuminate\Routing\Controller;
use Quidmye\Http\Requests\EventAddRequest;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }


    public function add()
    {
        return view('Qcalendar::events.add');
    }

    public function add_post(EventAddRequest $request)
    {

    }
}
