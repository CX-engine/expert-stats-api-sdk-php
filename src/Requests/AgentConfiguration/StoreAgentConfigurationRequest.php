<?php

namespace CXEngine\ExpertStats\Requests\AgentConfiguration;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class StoreAgentConfigurationRequest extends Request implements HasBody
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
        return '/v1.2/pbx3cx-agent-configurations';
    }

    protected function defaultBody(): array
    {
        // The backend has no {pbx} route segment on store - it resolves the
        // host from a `host_name` body field instead (see
        // Pbx3cxAgentConfigurationController::store).
        return array_merge($this->data, ['host_name' => $this->hostName]);
    }
}
