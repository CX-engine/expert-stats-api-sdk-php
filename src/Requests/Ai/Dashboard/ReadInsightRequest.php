<?php

namespace CXEngine\ExpertStats\Requests\Ai\Dashboard;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class ReadInsightRequest extends AiRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        string $hostName,
        protected readonly string $uuid,
    ) {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'dashboard/insights/' . $this->uuid . '/read';
    }
}
