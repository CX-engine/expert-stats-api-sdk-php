<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\AgentConfiguration as Endpoints;

/**
 * Wraps the `/v1.2/pbx3cx-agent-configurations[...]` endpoints.
 */
class AgentConfigurationResource extends Resource
{
    public function show(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\ShowAgentConfigurationRequest($hostName)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreAgentConfigurationRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateAgentConfigurationRequest($hostName, $data)
        );
    }
}
