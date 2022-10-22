<?php

declare(strict_types=1);

namespace App\Transporter\Requests;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\Transporter\Request;

class TeamsRequest extends Request
{
    protected string $method = 'GET';

    protected string $baseUrl = '';

    protected string $path = 'teams';

    protected array $data = [];

    public function __construct(HttpFactory $http)
    {
        parent::__construct($http);

        $this->setBaseUrl(config('services.football-api.url'));
    }

    protected function withRequest(PendingRequest $request): void
    {
        $request
            ->withHeaders([
                'x-rapidapi-key' => config('services.football-api.key'),
                'x-rapidapi-host' => config('services.football-api.host'),
            ]);
    }
}
