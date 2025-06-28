<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLine extends Model
{
    protected $fillable = ['start_date', 'end_date', 'goal', 'status'];
}