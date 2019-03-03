<?php

namespace Quidmye\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public function events()
    {
        return $this->hasMany('Quidmye\Event');
    }

    public function tokens()
    {
        return $this->hasMany('Quidmye\Token');
    }
}
