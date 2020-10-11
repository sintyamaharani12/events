<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $guardeo = [];

    public function user()
    {
        return $this->blongsTo('App\User');
    }
}