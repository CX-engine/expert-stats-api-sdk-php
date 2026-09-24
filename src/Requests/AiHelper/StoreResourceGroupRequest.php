<?php

namespace CXEngine\ExpertStats\Requests\AiHelper;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Creates a Pbx3cxHostResourceGroup. The backend re-validates and checks the
 * host's `ai_activated` flag before persisting — this request never
 * bypasses that.
 */
class StoreResourceGroupRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/'.$this->hostName.'/ai-helper/resource-groups';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
