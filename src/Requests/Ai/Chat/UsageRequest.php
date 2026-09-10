<?php

namespace CXEngine\ExpertStats\Requests\Ai\Chat;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class UsageRequest extends AiRequest
{
    protected Method $method = Method::GET;

    protected function path(): string
    {
        return 'usage';
    }
}
