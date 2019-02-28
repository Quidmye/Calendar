<?php

namespace Quidmye\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'users_push_tokens';

    protected $fillable = [
        'token', 'user_id'
    ];
}
