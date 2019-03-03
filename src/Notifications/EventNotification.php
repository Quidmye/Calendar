<?php

namespace Quidmye\Notifications;

use Illuminate\Notifications\Notification;
use Quidmye\Channels\GsmMessage;
use Quidmye\Channels\GsmChannel;

class EventNotification extends Notification
{

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return GcmMessage::create()
            ->title('Account approved')
            ->message("Your  account was approved!");
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
