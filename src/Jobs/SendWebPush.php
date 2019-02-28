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

    private $api_key = 'AAAAwPQ7cNU:APA91bFac0N-eq4kdAsCpU9Gb7QECDmJjKEp2WbtRMyEhn6vlUxXijDsfzU7dwI_udKnlmaKsdKtzFoMIlWLDCKoJ_eLe9hof58MfPBTi4UydGgU9ugn_r1x15_jlJU9l0PS4uhdhi_E';
    private $url = 'https://fcm.googleapis.com/fcm/send';

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function handle()
    {
        $this->event->where('remider_at', Carbon::now()->format("Y-m-d H:i:00"))
          ->orWhere('start_at', Carbon::now()->format("Y-m-d H:i:00"))
            =>chunk(100, function($events){
                foreach ($events as $event) {
                  $tokens = $event->user()->tokens()->get();
                  foreach ($tokens as $token) {
                    $body = json_encode([
                        'to' => $token->token,
                        'notification' => [
                            'title' => $event->name,
                            'body'  => $event->description,
                            'icon'  => 'https://quidmy.live/assets/Quidmye/img/user2-160x160.jpg',
                            'click_action' => route('event', $event),
                          ],
                        ]);
                    $headers = [
                        'Content-Type: application/json',
                        'Authorization: key=' . $this->api_key,
                    ];

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $this->url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    $response = curl_exec($ch);
                    curl_close($ch);
                  }
                }
            });
    }
}
