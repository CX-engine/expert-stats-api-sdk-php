<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\Stats as Endpoints;

/**
 * Wraps the read-only `/v1.2/{hostName}/...` call-statistics and report
 * endpoints (dashboard KPIs, trends, per-queue/user/number reports, origins).
 */
class StatsResource extends Resource
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function uniqueCallsPeriod(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\UniqueCallsPeriodRequest($hostName, $query)
        );
    }

    /**
     * @param  string  $type  'queue'|'extension'
     * @param  array<string, mixed>  $query
     */
    public function inboundCalls(string $hostName, string $type, array $query = [], bool $preAnswer = false): Response
    {
        return $this->connector->send(
            new Endpoints\InboundCallsRequest($hostName, $type, $query, $preAnswer)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function outboundCalls(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\OutboundCallsRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function usersCalls(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\UsersCallsRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function trendMonthly(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\TrendMonthlyRequest($hostName, $query)
        );
    }

    /**
     * @param  string  $type  'extension'|'queue'
     * @param  string  $granularity  'quarter-hour'|'hour'|'day'|'week'|'weekday'|'month'
     * @param  array<string, mixed>  $query
     */
    public function kpi(string $hostName, string $type, string $granularity, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\KpiRequest($hostName, $type, $granularity, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function queuesReport(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\QueuesReportRequest($hostName, $query)
        );
    }

    /**
     * Streams a binary file export. Callers must NOT call `->json()` on the
     * returned response.
     *
     * @param  array<string, mixed>  $data
     */
    public function getQueueReportFile(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\QueueReportFileAggregatedRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function usersReport(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\UsersReportRequest($hostName, $query)
        );
    }

    /**
     * Streams a binary file export. Callers must NOT call `->json()` on the
     * returned response.
     *
     * @param  array<string, mixed>  $data
     */
    public function getUserReportFile(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UserReportFileRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function standardDashboard(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\StandardDashboardRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function callersReport(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\CallersReportRequest($hostName, $query)
        );
    }

    /**
     * Streams a binary file export. Callers must NOT call `->json()` on the
     * returned response.
     *
     * @param  array<string, mixed>  $data
     */
    public function getCallerReportFile(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\CallerReportFileRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function didReport(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Endpoints\DidReportRequest($hostName, $query)
        );
    }

    /**
     * Streams a binary file export. Callers must NOT call `->json()` on the
     * returned response.
     *
     * @param  array<string, mixed>  $data
     */
    public function getDidReportFile(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\DidReportFileRequest($hostName, $data)
        );
    }

    public function searchCallerNumbers(string $hostName, string $search): Response
    {
        return $this->connector->send(
            new Endpoints\CallerNumbersSearchRequest($hostName, ['search' => $search])
        );
    }

    public function map(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\MapRequest($hostName)
        );
    }

    public function resourceGroups(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\ResourceGroupsRequest($hostName)
        );
    }

    /**
     * @param  string  $type  'queue'|'extension'
     * @param  array<string, mixed>  $query
     */
    public function origin(string $hostName, string $type, array $query = [], bool $top = false): Response
    {
        return $this->connector->send(
            new Endpoints\OriginRequest($hostName, $type, $query, $top)
        );
    }
}
