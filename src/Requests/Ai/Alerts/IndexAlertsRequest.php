<?php

namespace CXEngine\ExpertStats\Requests\Ai\Alerts;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class IndexAlertsRequest extends AiRequest
{
    protected Method $method = Method::GET;

    protected function path(): string
    {
        return 'alerts';
    }
}
