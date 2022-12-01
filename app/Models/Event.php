<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGoals($query): Builder
    {
        return $query
            ->where('type', 'Goal')
            ->whereIn('detail', ['Normal Goal', 'Penalty', 'Own Goal']);
    }
}
