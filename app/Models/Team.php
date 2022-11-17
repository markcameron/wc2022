<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'name',
        'code',
    ];

    protected $appends = [
        'flag',
    ];

    /**
     * Get the Fixture detail URL
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function flag(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => flag($this->flag_code, 'w-6', [$this->code === 'che' ? 'style="max-height:18px;"' : ''])->toHtml(),
        );
    }

    /**
     * Get the Fixture detail URL
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function flagCode(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => match ($this->code) {
                'arg' => 'ar',
                'aus' => 'au',
                'bel' => 'be',
                'bra' => 'br',
                'can' => 'ca',
                'che' => 'ch:1x1',
                'cmr' => 'cm',
                'cri' => 'cr',
                'deu' => 'de',
                'dnk' => 'dk',
                'ecu' => 'ec',
                'esp' => 'es',
                'fra' => 'fr',
                'gha' => 'gh',
                'hrv' => 'hr',
                'irn' => 'ir',
                'jpn' => 'jp',
                'kor' => 'kr',
                'mar' => 'ma',
                'mex' => 'mx',
                'nld' => 'nl',
                'pol' => 'pl',
                'prt' => 'pt',
                'qat' => 'qa',
                'sau' => 'sa',
                'sen' => 'sn',
                'srb' => 'rs',
                'tun' => 'tn',
                'ury' => 'uy',
                'usa' => 'us',
                default => $this->code,
            },
        );
    }
}
