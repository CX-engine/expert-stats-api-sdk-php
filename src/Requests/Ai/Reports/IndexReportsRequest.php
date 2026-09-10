<?php

namespace CXEngine\ExpertStats\Requests\Ai\Reports;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class IndexReportsRequest extends AiRequest
{
    protected Method $method = Method::GET;

    protected function path(): string
    {
        return 'reports';
    }
}
