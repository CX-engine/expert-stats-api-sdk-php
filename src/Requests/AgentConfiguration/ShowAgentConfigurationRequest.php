<?php

namespace CXEngine\ExpertStats\Requests\AgentConfiguration;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ShowAgentConfigurationRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $hostName,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-agent-configurations/' . $this->hostName;
    }
}
