<?php

namespace CXEngine\ExpertStats\Requests\Stats;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Base class for the read-only, host-scoped `/v1.2/{hostName}/...` stats/report
 * endpoints. Concrete requests only need to provide the path segment and the
 * query params; responses are left as plain JSON (no Entity/DTO), since callers
 * feed them straight into data-aggregation code rather than typed objects.
 */
abstract class HostScopedStatsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  array<string, mixed>  $queryParams
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $queryParams = [],
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/v1.2/{$this->hostName}/{$this->path()}";
    }

    protected function defaultQuery(): array
    {
        return array_filter($this->queryParams, fn ($value) => $value !== null);
    }

    abstract protected function path(): string;
}
