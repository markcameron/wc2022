<?php

declare(strict_types=1);

namespace App\Transporter\Requests;

use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\Transporter\Request;
use Illuminate\Http\Client\Factory as HttpFactory;

class BaseRequest extends Request
{

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
