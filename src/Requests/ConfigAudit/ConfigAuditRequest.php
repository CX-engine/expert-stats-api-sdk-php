<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Base class for the host-scoped `/v1.2/{hostName}/config-audit/...`
 * endpoints: 3CX configuration audit (score, recommendations, routing,
 * queues, agents). Most of them accept an optional statistics period
 * (`start_date` / `end_date`, default last 30 days on the server).
 */
abstract class ConfigAuditRequest extends Request
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
        $path = $this->path();

        return "/v1.2/{$this->hostName}/config-audit".($path === '' ? '' : "/{$path}");
    }

    protected function defaultQuery(): array
    {
        return array_filter($this->queryParams, fn ($value) => $value !== null && $value !== '' && $value !== []);
    }

    abstract protected function path(): string;
}
