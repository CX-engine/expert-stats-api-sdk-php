<?php

namespace CXEngine\ExpertStats\Requests\Ai\Reports;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class DeleteReportRequest extends AiRequest
{
    protected Method $method = Method::DELETE;

    public function __construct(
        string $hostName,
        protected readonly string $uuid,
    ) {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'reports/' . $this->uuid;
    }
}
