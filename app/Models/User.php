<?php

namespace App\Models;

use App\Models\Fixture;
use App\Services\ScoreService;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'display_name',
    ];

    public function predictions()
    {
        return $this->hasMany('App\Models\Prediction');
    }

    public function prediction(Fixture $fixture)
    {
        return $this->predictions()->where('fixture_id', $fixture->id)->first();
    }

    public function getScoreAttribute()
    {
        return resolve(ScoreService::class)->getUserScore($this);
    }

    /**
     * Get the user display_name
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function displayName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->nickname ?? $this->name,
        );
    }

    /**
     * Get the user display_name
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function predictionState(Fixture $fixture)
    {
        $prediction = $this->prediction($fixture);
        return resolve(ScoreService::class)->getPredictionStatus($prediction);
    }

    /**
     * Get the status of number of predictions
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function predictionStatus(): Attribute
    {
        $count = $this->predictions->count();
        $total = Fixture::count();
        $color = 'text-danger-500';
        if ($count === $total) {
            $color = 'text-success-500';
        }
        return Attribute::make(
            get: fn ($value) => '<span class="' . $color . '">' . $count . ' / ' . $total . '</span>',
        );
    }

    /**
     * Get the status of number of predictions
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function missingPredictionsCount(): Attribute
    {
        $fixturesToPredict = Fixture::canPredict()->get();

        return Attribute::make(
            get: fn ($value) => $fixturesToPredict->filter(fn ($fixture) => !$fixture->userPrediction)->count(),
        );
    }

    public function canAccessFilament(): bool
    {
        return in_array($this->email, [
            'admin@example.com',
            'budfrogfryer@gmail.com',
        ]);
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=953044&background=eeeee4';
    }
}
