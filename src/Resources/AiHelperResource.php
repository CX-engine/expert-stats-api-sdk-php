<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\AiHelper as Endpoints;

/**
 * Wraps `/v1.2/{hostName}/ai-helper/...` — the AI actions assistant's
 * (cx-engine/expert-statistics package) narrow, strictly-validated surface
 * for creating/scheduling Pbx3cxReports and creating Pbx3cxHostResourceGroups
 * on a user's behalf. Deliberately separate from ReportResource/ResourceGroupResource,
 * which wrap the legacy, loosely-validated manual-UI endpoints.
 */
class AiHelperResource extends Resource
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function validateReport(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\ValidateReportRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function createReport(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreReportRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function validateResourceGroup(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\ValidateResourceGroupRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function createResourceGroup(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreResourceGroupRequest($hostName, $data)
        );
    }
}
