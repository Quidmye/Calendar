<?php

namespace Quidmye\Channels;

class GcmMessage
{

    public $title;

    public $message;

    public $action;

    public $data = [];

    public $notification = [];
    /**
     * Create a new message instance.
     *
     * @param string|null $title
     * @param string|null $message
     * @param array $data
     * @param string $priority
     * @return static
     */
    public static function create($title = null, $message = null, $data = [], $notification = [])
    {
        return new static($title, $message, $data, $notification);
    }
    /**
     * Create a new message instance.
     *
     * @param string|null $title
     * @param string|null $message
     * @param array $data
     * @param string $priority
     * @param string $sound
     */
    public function __construct($title = null, $message = null, $data = [], $notification = [])
    {
        $this->title = $title;
        $this->message = $message;
        $this->data = $data;
        $this->notification = $notification;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function action($action)
    {
        $this->action = $action;
        return $this;
    }

    public function data($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function notification($key, $value)
    {
        $this->notification[$key] = $value;
        return $this;
    }

    public function setNotification($notification)
    {
        $this->notification = $notification;
        return $this;
    }

}
