<?php

namespace Quidmye;

class Calendar
{
    public static function load()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'Quidmye');
        
        return view('Qcalendar::layout');
    }
   
}
