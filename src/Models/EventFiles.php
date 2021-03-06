<?php

namespace Quidmye\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EventFiles extends Model
{
    protected $table = 'events_files';

    public $timestamps = false;

    protected $fillable = [
        'path', 'event_id', 'type'
    ];

    public function event()
    {
        return $this->belongsTo('Quidmye\Models\Event');
    }

}
