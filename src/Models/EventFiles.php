<?php

namespace Quidmye\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EventFiles extends Model
{
    protected $table = 'events_files';

    protected $fillable = [
        'path', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo('Quidmye\Event');
    }

}
