<?php

namespace CXEngine\ExpertStats\Requests\Ai\Alerts;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class DismissAlertRequest extends AiRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        string $hostName,
        protected readonly int $alert,
    ) {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'alerts/' . $this->alert . '/dismiss';
    }
}
