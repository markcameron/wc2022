<?php

declare(strict_types=1);

namespace App\Transporter\Requests;

use App\Transporter\Requests\BaseRequest;

class FixtureEventsRequest extends BaseRequest
{
    protected string $method = 'GET';

    protected string $path = 'fixtures/events';
}
