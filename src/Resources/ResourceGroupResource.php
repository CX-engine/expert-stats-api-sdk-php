<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\ResourceGroup as Endpoints;

/**
 * Wraps the write endpoints for `/v1.2/{hostName}/resource-groups/...`. The
 * read-only index endpoint already exists as {@see StatsResource::resourceGroups()}.
 */
class ResourceGroupResource extends Resource
{
    public function show(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\ShowResourceGroupRequest($hostName, $id)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreResourceGroupRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $hostName, int $id, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateResourceGroupRequest($hostName, $id, $data)
        );
    }

    public function delete(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteResourceGroupRequest($hostName, $id)
        );
    }
}
