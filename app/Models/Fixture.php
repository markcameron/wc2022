<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $appends = [
        'url',
    ];

    public function homeTeam() {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam() {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function venue() {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => route('fixtures.show', $this->id),
        );
    }
}
