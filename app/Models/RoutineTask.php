<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutineTask extends Model
{
    protected $fillable = ['day_id', 'routine_id', 'status'];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
}
