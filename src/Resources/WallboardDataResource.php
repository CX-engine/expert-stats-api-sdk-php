<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\WallboardData as Endpoints;

/**
 * Wraps the live wallboard-data endpoints (`/v1.2/{hostName}/wallboard[-aggregated]/...`)
 * plus the public, non-host-scoped share view. For the saved wallboard
 * layout configs themselves, see {@see WallboardResource}.
 */
class WallboardDataResource extends Resource
{
    public function hasData(string $hostName, bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\HasDataRequest($hostName, [], $aggregated)
        );
    }

    public function live(string $hostName, bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\LiveRequest($hostName, [], $aggregated)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function summary(string $hostName, array $query = [], bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\SummaryRequest($hostName, $query, $aggregated)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function overview(string $hostName, array $query = [], bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\OverviewRequest($hostName, $query, $aggregated)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function timeseries(string $hostName, array $query = [], bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\TimeseriesRequest($hostName, $query, $aggregated)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function calls(string $hostName, array $query = [], bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\CallsRequest($hostName, $query, $aggregated)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function meta(string $hostName, array $query = [], bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\MetaRequest($hostName, $query, $aggregated)
        );
    }

    /**
     * @param  array<int, array<string, mixed>>  $tiles
     */
    public function resolve(string $hostName, array $tiles, bool $aggregated = false): Response
    {
        return $this->connector->send(
            new Endpoints\ResolveRequest($hostName, $tiles, $aggregated)
        );
    }

    public function publicShare(string $key): Response
    {
        return $this->connector->send(
            new Endpoints\PublicShareRequest($key)
        );
    }
}
