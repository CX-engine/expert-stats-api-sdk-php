<?php

namespace CXEngine\ExpertStats\Requests\Ai\Chat;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class DeleteChatHistoryRequest extends AiRequest
{
    protected Method $method = Method::DELETE;

    protected function path(): string
    {
        return 'chat/history';
    }
}
