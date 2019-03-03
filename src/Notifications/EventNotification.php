<?php

namespace Quidmye\Notifications;

use Illuminate\Notifications\Notification;
use Quidmye\Channels\GcmMessage;
use Quidmye\Channels\GcmChannel;

class EventNotification extends Notification
{

    publi $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable = null)
    {
        return [GcmChannel::class];
    }

    public function toGcm($notifiable = null)
    {
      dd($notifiable);
        return GcmMessage::create()
            ->title($this->event->name)
            ->message($this->event->description);
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
