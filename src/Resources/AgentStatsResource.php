<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\AgentStats as Endpoints;

/**
 * Wraps the read-only `/v1.2/agent-stats/{hostName}/...` agent statistics
 * endpoints.
 */
class AgentStatsResource extends Resource
{
    public function hasData(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\HasDataRequest($hostName)
        );
    }

    public function hasDataLive(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\HasDataLiveRequest($hostName)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function overview(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\OverviewRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function statusBreakdown(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\StatusBreakdownRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function queueCoverageUsers(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\QueueCoverageUsersRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function queueCoverageQueues(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\QueueCoverageQueuesRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function queueCoverage(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\QueueCoverageRequest($hostName, $query)
        );
    }

    public function realtimeStatus(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\RealtimeStatusRequest($hostName)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function dailyActivity(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\DailyActivityRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function queueConnection(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\QueueConnectionRequest($hostName, $query)
        );
    }
}
