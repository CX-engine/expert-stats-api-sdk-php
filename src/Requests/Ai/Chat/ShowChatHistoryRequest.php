<?php

namespace CXEngine\ExpertStats\Requests\Ai\Chat;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class ShowChatHistoryRequest extends AiRequest
{
    protected Method $method = Method::GET;

    public function __construct(
        string $hostName,
        protected readonly string $uuid,
    ) {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'chat/history/' . $this->uuid;
    }
}
