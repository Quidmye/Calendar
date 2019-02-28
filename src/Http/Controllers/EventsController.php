<?php

namespace Quidmye\Http\Controllers;

use Illuminate\Routing\Controller;
use Quidmye\Http\Requests\EventAddRequest;
use Quidmye\Models\Event;
use Quidmye\Models\EventFiles;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web', 'auth']);
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
          'user_id'     =>  \Auth::user()->id
        ];

        //Да, с краткими записями не успел подружиться
        if($request->has('reminder')){
          $data['reminder_at'] = $request->input('reminder_time');
        }else{
          $data['reminder_at'] = NULL;
        }

        $event = Event::create($data);

        if($request->has('event_files')){
          $this->uploadFile($request->event_files);
        }

        if($request->ajax()){
          return [
            //'redirect'  =>  route('event', $event)
          ];
        }else{
          redirect(route('event', $event));
        }
    }

    private function uploadFile($data){
      $dir = public_path('storage/' . date('Y/m/d'));
      if(!is_dir($dir)){
        mkdir($dir ,0777, true);
      }
      foreach ($data as $file) {
        $path = $dir . '/' . $file->getClientOriginalName();
        if(file_exists($path)){
          $path = $dir . microtime() . '.' . $file->getClientOriginalExtension();
        }
        $file->move($path);
        if(in_array($file->getMimeType(), ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'])){
          $type = 'image';
        }else{
          $type = 'audio';
        }
        EventFiles::create([
          'path' => $path,
          'type' => $type,
          'event_id'  => $event->id
        ]);
      }
    }
}
