<?php

namespace Quidmye\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'users_push_tokens';

    public $timestamps = false;

    protected $fillable = [
        'token', 'user_id', 'browser'
    ];

    public function user(){
      return belongsTo('App\User');
    }
}
