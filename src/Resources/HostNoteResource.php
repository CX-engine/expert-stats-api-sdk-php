<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\HostNote as Endpoints;

/**
 * Wraps the `/v1.2/{hostName}/pbx3cx-notes[...]` endpoints.
 */
class HostNoteResource extends Resource
{
    public function index(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\IndexHostNoteRequest($hostName)
        );
    }

    public function show(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\ShowHostNoteRequest($hostName, $id)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreHostNoteRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $hostName, int $id, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateHostNoteRequest($hostName, $id, $data)
        );
    }

    public function delete(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteHostNoteRequest($hostName, $id)
        );
    }
}
