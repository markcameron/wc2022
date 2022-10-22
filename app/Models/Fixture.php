<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fixture extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'date',
        'home_team_id',
        'away_team_id',
        'venue_id',
        'stage',
        'can_predict',
    ];

    public function homeTeam() {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam() {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function venue() {
        return $this->belongsTo(Venue::class);
    }
}
