<?php

namespace Quidmye\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    public $timestamps = false;

    protected $fillable = [
        'name', 'start_at', 'end_at', 'reminder_at', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('Quidmye\User');
    }

    public function setStartTImeAttribute($value){
      $this->attributes['start_at'] = \Carbon::parse($value)->format("Y-m-d H:i:00");
    }

    public function setEndTImeAttribute($value){
      $this->attributes['end_at'] = \Carbon::parse($value)->format("Y-m-d H:i:00");
    }

    public function setEndTImeAttribute($value){
      $this->attributes['reminder_at'] = \Carbon::parse($value)->format("Y-m-d H:i:00");
    }
}
