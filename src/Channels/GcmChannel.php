<?php

namespace Quidmye\Channels;

use Illuminate\Notifications\Notification;

class GcmChannel
{

  protected $recipients;
  protected $subject;
  protected $message;
  protected $key;
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
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $response = curl_exec($ch);
      curl_close($ch);
    }

    public function setData($tokens, $message){
      $this->key = env('GCM_KEY');
      $this->headers = [
        'Content-Type: application/json',
        'Authorization: key=' . $this->key,
      ];
      $data =  [
        'to' => $this->recipients,
        'notification' => [
          'title' => $message->title,
          'body'  => $message->message,
        ],
      ];

    }
}
