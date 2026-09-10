<?php

namespace CXEngine\ExpertStats\Requests\Ai\Dashboard;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class RefreshDashboardRequest extends AiRequest
{
    protected Method $method = Method::POST;

    protected function path(): string
    {
        return 'dashboard/refresh';
    }
}
