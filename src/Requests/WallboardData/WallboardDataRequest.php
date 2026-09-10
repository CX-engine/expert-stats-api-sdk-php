<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Base class for the read-only, host-scoped live wallboard-data endpoints.
 * The backend exposes two parallel route families - `/v1.2/{hostName}/wallboard/...`
 * and `/v1.2/{hostName}/wallboard-aggregated/...` - selected by `$aggregated`
 * (mirrors {@see \CXEngine\ExpertStats\Resources\StatsResource::origin()}'s
 * `$top` flag).
 */
abstract class WallboardDataRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  array<string, mixed>  $queryParams
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $queryParams = [],
        protected readonly bool $aggregated = false,
    ) {
    }

    public function resolveEndpoint(): string
    {
        $segment = $this->aggregated ? 'wallboard-aggregated' : 'wallboard';

        return "/v1.2/{$this->hostName}/{$segment}/{$this->path()}";
    }

    protected function defaultQuery(): array
    {
        return array_filter($this->queryParams, fn ($value) => $value !== null);
    }

    abstract protected function path(): string;
}
