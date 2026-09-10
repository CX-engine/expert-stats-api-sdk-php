<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\ReportTableConfig as Endpoints;

/**
 * Wraps the `/v1.2/pbx3cx-report-table-configurations[...]` endpoints. Not
 * host-scoped — scoped by the backend's XP-Stats customer identifier.
 */
class ReportTableConfigResource extends Resource
{
    public function index(): Response
    {
        return $this->connector->send(
            new Endpoints\IndexReportTableConfigRequest()
        );
    }

    public function show(string $customer): Response
    {
        return $this->connector->send(
            new Endpoints\ShowReportTableConfigRequest($customer)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Response
    {
        return $this->connector->send(
            new Endpoints\CreateReportTableConfigRequest($data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $customer, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateReportTableConfigRequest($customer, $data)
        );
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteReportTableConfigRequest($id)
        );
    }
}
