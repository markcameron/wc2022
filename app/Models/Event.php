<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'fixture_id',
        'team_id',
        'type',
        'time_elapsed',
        'time_extra',
        'player_id',
        'player_name',
        'assist_id',
        'assist_name',
        'detail',
        'comments',
    ];
}
