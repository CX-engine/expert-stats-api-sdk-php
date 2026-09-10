<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\Alert as Endpoints;

/**
 * Wraps the `/v1.2/{hostName}/alerts[...]` endpoints. The backend has no
 * single-alert show endpoint - only index, store and delete.
 */
class AlertResource extends Resource
{
    public function index(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\IndexAlertRequest($hostName)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreAlertRequest($hostName, $data)
        );
    }

    public function delete(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteAlertRequest($hostName, $id)
        );
    }
}
