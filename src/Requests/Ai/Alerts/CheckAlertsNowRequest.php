<?php

namespace CXEngine\ExpertStats\Requests\Ai\Alerts;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class CheckAlertsNowRequest extends AiRequest
{
    protected Method $method = Method::POST;

    protected function path(): string
    {
        return 'alerts/check';
    }
}
