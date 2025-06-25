<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = ['title', 'description', 'status', 'day_id'];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}