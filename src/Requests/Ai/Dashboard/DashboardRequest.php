<?php

namespace CXEngine\ExpertStats\Requests\Ai\Dashboard;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class DashboardRequest extends AiRequest
{
    protected Method $method = Method::GET;

    protected function path(): string
    {
        return 'dashboard';
    }
}
