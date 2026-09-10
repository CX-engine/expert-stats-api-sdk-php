<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\PreanswerTime as Endpoints;

/**
 * Wraps the `/v1.2/{hostName}/preanswer-times[...]` endpoints.
 */
class PreanswerTimeResource extends Resource
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function index(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\IndexPreanswerTimeRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StorePreanswerTimeRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function delete(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\DeletePreanswerTimeRequest($hostName, $query)
        );
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    public function bulkStore(string $hostName, array $items): Response
    {
        return $this->connector->send(
            new Endpoints\BulkStorePreanswerTimeRequest($hostName, $items)
        );
    }

    /**
     * @param  array<int, int>  $ids
     */
    public function bulkDelete(string $hostName, array $ids): Response
    {
        return $this->connector->send(
            new Endpoints\BulkDeletePreanswerTimeRequest($hostName, $ids)
        );
    }
}
