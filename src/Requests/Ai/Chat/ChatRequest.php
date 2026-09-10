<?php

namespace CXEngine\ExpertStats\Requests\Ai\Chat;

use Saloon\Enums\Method;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class ChatRequest extends AiRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        string $hostName,
        protected readonly string $message,
        protected readonly ?string $conversationUuid = null,
        protected readonly ?string $language = null,
        protected readonly bool $isSummary = false,
    ) {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'chat';
    }

    protected function defaultBody(): array
    {
        return array_filter([
            'message' => $this->message,
            'conversation_id' => $this->conversationUuid,
            'language' => $this->language,
            'is_summary' => $this->isSummary,
        ], fn ($value) => $value !== null);
    }
}
