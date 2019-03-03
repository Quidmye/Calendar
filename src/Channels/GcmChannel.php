<?php

namespace Quidmye\Channels;

use Illuminate\Notifications\Notification;

class GcmChannel
{

  protected $recipients;
  protected $subject;
  protected $message;
  protected $key;
  protected $data;
  protected $headers;
  protected $server = "https://fcm.googleapis.com/fcm/send";


    public function send($notifiable, Notification $notification)
    {
      $this->recipients = (array) $notifiable->routeNotificationFor('gcm', $notification);

      $this->message = $notification->toGcm($notifiable);
      if (! $this->message) {
          return;
      }

      $data = $this->setData($this->recipients, $this->message);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->server);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $result = curl_exec($ch);
      var_dump($result);
      curl_close($ch);
    }

    public function setData($tokens, $message){
      $this->key = env('GCM_KEY');
      $this->headers = [
        'Content-Type: application/json',
        'Authorization: key=' . $this->key,
      ];
      $this->data =  [
        'to' => json_encode($this->recipients),
        'notification' => [
          'title' => $message->title,
          'body'  => $message->message,
        ],
      ];

    }
}
