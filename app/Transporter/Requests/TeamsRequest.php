<?php

declare(strict_types=1);

namespace App\Transporter\Requests;

use App\Transporter\Requests\BaseRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Factory as HttpFactory;

class TeamsRequest extends BaseRequest
{
    protected string $method = 'GET';

    protected string $path = 'teams';

}
