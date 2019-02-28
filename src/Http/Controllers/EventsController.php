<?php

namespace Quidmye\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Quidmye\Http\Requests\EventAddRequest;
use Quidmye\Http\Requests\EventAddAjaxRequest;
use Quidmye\Http\Requests\EventEditRequest;
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
      $body = json_encode([
          'project_id' => 'quidmy-2ed55',
          'to' => array("dsDG3bDbldM:APA91bG5mvhK0srZiXsW-nNN0JYoMq-_fYGIWEwvwa9Ve1gK1H0lAZ2jWfeduPyWpn0wMpM0_pqYOH-5hgkkiUZ9-sIeTRry2jVvUYVDscdhAEnccYsjHOwy21C9E6o3Zj0_POZCSF2w"),
          'notification' => [
              'title' => "fdsadsadsadsasad",
              'body'  => "dsadsadsadsadsa",
              'icon'  => 'https://quidmy.live/assets/Quidmye/img/user2-160x160.jpg',
              'click_action' => route('event', ['id' => '1']),
            ],
          ]);
      $headers = [
          'Content-Type: application/json',
          'Authorization: key=' . "AAAAwPQ7cNU:APA91bFac0N-eq4kdAsCpU9Gb7QECDmJjKEp2WbtRMyEhn6vlUxXijDsfzU7dwI_udKnlmaKsdKtzFoMIlWLDCKoJ_eLe9hof58MfPBTi4UydGgU9ugn_r1x15_jlJU9l0PS4uhdhi_E",
      ];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,  "https://fcm.googleapis.com/fcm/send");
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
      $result = curl_exec($ch);
      var_dump($result);
      curl_close($ch);
        return view('Qcalendar::events.add');
    }

    public function add_ajax(EventAddAjaxRequest $request){
      $event = Event::create([
        'name' => $request->input('name'),
        'start_at' => $request->input('time'),
        'end_at' => $request->input('time'),
        'user_id' => \Auth::user()->id
      ]);
      return $event;
    }

    public function show($id){
      $event = Event::findOrFail($id);

      if($event->user_id !== \Auth::user()->id){
        abort(404);
      }

      return view('Qcalendar::events.show', ['event' => $event]);
    }

    public function delete($id){
      $event = Event::findOrFail($id);

      if($event->user_id !== \Auth::user()->id){
        abort(404);
      }

      $event->delete();

      return redirect('/');

    }

    public function edit($id){
      $event = Event::findOrFail($id);

      if($event->user_id !== \Auth::user()->id){
        abort(404);
      }

      return view('Qcalendar::events.edit', ['event' => $event]);
    }

    public function edit_post($id, EventEditRequest $request){

      $event = Event::findOrFail($id);

      if($event->user_id !== \Auth::user()->id){
        abort(404);
      }


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

      $event->update($data);

      if($request->has('event_files')){
        $this->uploadFile($request->event_files, $event);
      }

      if($request->ajax()){
        return [
          'redirect'  =>  route('event', $event)
        ];
      }else{
        redirect(route('event', $event));
      }

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
          $this->uploadFile($request->event_files, $event);
        }

        if($request->ajax()){
          return [
            'redirect'  =>  route('event', $event)
          ];
        }else{
          redirect(route('event', $event));
        }
    }

    public function delete_file($id){
      $file = EventFiles::findOrFail($id);
      $event = $file->event()->first();
      if($event->user_id != \Auth::user()->id){
        abort();
      }

      $file->delete();

      return "dsadsadsasad";
    }

    public function list(Request $request){

      $where[] = ['user_id', '=', \Auth::user()->id];


      if($request->get('start')){
        $where[] = ['start_at', '>=', $request->get('start')];
      }

      if($request->get('end')){
        $where[] = ['end_at', '<=', $request->get('end')];
      }
      $list = Event::where($where)->get();
      $response = [];
      if($request->ajax())
      {
        foreach ($list as $event) {
          $response[] = [
            'title' => $event->name,
            'start' => $event->start_at->format('c'),
            'end'   => $event->end_at->format('c'),
            'color' => '#f56954',
            'url'   => route('event', $event)
          ];
        }
        return $response;
      }
      return view('Qcalendar::events.list', ['events' => $list]);

    }

    private function uploadFile($data, $event){
      foreach ($data as $file) {
        $path = $file->store('public/events');
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
