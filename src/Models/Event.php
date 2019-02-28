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
}
