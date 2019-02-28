<?php

namespace Quidmye\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $table = 'events';

    public $timestamps = false;

    protected $fillable = [
        'name', 'start_at', 'end_at', 'reminder_at', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('Quidmye\Models\User');
    }

    public function files()
    {
        return $this->hasMany('Quidmye\Models\EventFiles');
    }

    public function setStartAtAttribute($value){
      $this->attributes['start_at'] = Carbon::parse($value)->format("Y-m-d H:i:00");
    }

    public function setEndAtAttribute($value){
      $this->attributes['end_at'] = Carbon::parse($value)->format("Y-m-d H:i:00");
    }

    public function setReminderAtAttribute($value){
      if(is_null($value)){
        return null;
      }
      $this->attributes['reminder_at'] = Carbon::parse($value)->format("Y-m-d H:i:00");
    }
}
