<?php

namespace Quidmye\Jobs;

use Carbon\Carbon;
use Quidmye\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWebPush implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;

    public function __construct()
    {
    }

    public function handle()
    {
      $events = Event::where('reminder_at', Carbon::now()->format("Y-m-d H:i:00"))
        ->orWhere('start_at', Carbon::now()->format("Y-m-d H:i:00"))->with(array('user' => function($query)
          {
              $query->with('tokens');
          }))
          ->chunk(100, function($events){
              foreach ($events as $event) {
                foreach ($event->user->tokens as $token) {
                  Notification::route('gcm', $token->token)->notify(new EventNotification($event));
                }
              }
          });
    }
}
