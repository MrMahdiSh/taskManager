<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = ['date', 'summary'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}