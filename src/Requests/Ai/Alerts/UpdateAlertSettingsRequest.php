<?php

namespace CXEngine\ExpertStats\Requests\Ai\Alerts;

use Saloon\Enums\Method;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

class UpdateAlertSettingsRequest extends AiRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        string $hostName,
        protected readonly array $data,
    ) {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'alerts/settings';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
