<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\Cdr as Endpoints;

/**
 * Wraps the `/v1.2/{hostName}/cdr-report[...]` endpoints.
 */
class CdrResource extends Resource
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function report(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\CdrReportRequest($hostName, $query)
        );
    }

    /**
     * Streams a binary xlsx file. Callers must NOT call `->json()` on the
     * returned response - use `->body()` (or `->stream()`) instead.
     *
     * @param  array<string, mixed>  $query
     */
    public function export(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\CdrExportRequest($hostName, $query)
        );
    }

    /**
     * Streams a binary CSV file. Callers must NOT call `->json()` on the
     * returned response - use `->body()` (or `->stream()`) instead.
     *
     * @param  array<string, mixed>  $data
     */
    public function getHostReportFile(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\HostReportFileRequest($hostName, $data)
        );
    }
}
