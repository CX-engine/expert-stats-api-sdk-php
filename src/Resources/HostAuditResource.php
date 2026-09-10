<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\HostAudit as Endpoints;

/**
 * Wraps the `/v1.2/{hostName}/pbx3cx-audits[...]` endpoints.
 */
class HostAuditResource extends Resource
{
    public function index(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\IndexHostAuditRequest($hostName)
        );
    }

    public function show(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\ShowHostAuditRequest($hostName, $id)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreHostAuditRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $hostName, int $id, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateHostAuditRequest($hostName, $id, $data)
        );
    }

    public function delete(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteHostAuditRequest($hostName, $id)
        );
    }
}
