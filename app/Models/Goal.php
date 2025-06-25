<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['title', 'description', 'status', 'deadline', 'priority'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}