<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\Wallboard as Endpoints;

/**
 * Wraps the `/v1.2/{hostName}/wallboards[...]` configuration endpoints (the
 * saved wallboard layouts). For the live wallboard data itself, see
 * {@see WallboardDataResource}.
 */
class WallboardResource extends Resource
{
    public function index(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\IndexWallboardRequest($hostName)
        );
    }

    public function show(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Endpoints\ShowWallboardRequest($hostName, $uuid)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreWallboardRequest($hostName, $data)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $hostName, string $uuid, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateWallboardRequest($hostName, $uuid, $data)
        );
    }

    public function delete(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteWallboardRequest($hostName, $uuid)
        );
    }

    /**
     * AI-generates a wallboard layout. Uses a longer request timeout than
     * the connector default - see {@see Endpoints\BuildWallboardRequest}.
     *
     * @param  array<string, mixed>  $data
     */
    public function build(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\BuildWallboardRequest($hostName, $data)
        );
    }

    public function setActive(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Endpoints\SetActiveWallboardRequest($hostName, $uuid)
        );
    }

    public function revert(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Endpoints\RevertWallboardRequest($hostName, $uuid)
        );
    }
}
