<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['type', 'title', 'content', 'day_id'];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}