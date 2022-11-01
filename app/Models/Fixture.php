<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Prediction;
use Illuminate\Support\Facades\Auth;
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
        'url_prediction',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function userPrediction()
    {
        return $this->hasOne(Prediction::class)->whereUserId(Auth::user()->id);
    }

    public function goalsHome()
    {
        return $this->hasMany(Goal::class)->whereTeam('home');
    }

    public function goalsAway()
    {
        return $this->hasMany(Goal::class)->whereTeam('away');
    }

    /**
     * Get the Fixture detail URL
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => route('fixtures.show', $this->id),
        );
    }

    /**
     * Get the Prediction detail URL
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function urlPrediction(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => route('predictions.show', $this->id),
        );
    }
}
