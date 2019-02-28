<?php

namespace Quidmye\Http\Controllers;

use Illuminate\Routing\Controller;
use Quidmye\Http\Requests\EventAddRequest;
use Quidmye\Models\Event;

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
        $data = [
          'name'        =>  $request->input('name'),
          'start_at'    =>  $request->input('start_time'),
          'end_at'      =>  $request->input('end_time'),
          'description' =>  $request->input('description'),
          'user_id'     =>  auth()->id
        ];
        $data['reminder_at'] = $request->has('reminder') ? $request->input('reminder_time') : null;

        $event = Event::create($data);

        return $event;
    }
}
