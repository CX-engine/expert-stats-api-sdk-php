<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\Report as Endpoints;

/**
 * Wraps the `/v1.2/{hostName}/reports[...]` scheduled report endpoints.
 * Does NOT wrap the public `GET v1.2/reports/{key}` generate route or
 * `GET reports/unsubscribe` - those are hit directly by email recipients,
 * out of scope entirely.
 */
class ReportResource extends Resource
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function index(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\IndexReportRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreReportRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $hostName, int $id, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateReportRequest($hostName, $id, $data)
        );
    }

    public function delete(string $hostName, int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteReportRequest($hostName, $id)
        );
    }
}
