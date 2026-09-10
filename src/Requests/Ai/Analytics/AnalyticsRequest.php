<?php

namespace CXEngine\ExpertStats\Requests\Ai\Analytics;

use Saloon\Enums\Method;
use CXEngine\ExpertStats\Requests\Ai\AiRequest;

/**
 * Base class for the read-only `/v1.2/{hostName}/ai/analytics/...` endpoints.
 */
abstract class AnalyticsRequest extends AiRequest
{
    protected Method $method = Method::GET;

    /**
     * @param  array<string, mixed>  $queryParams
     */
    public function __construct(
        string $hostName,
        protected readonly array $queryParams = [],
    ) {
        parent::__construct($hostName);
    }

    protected function defaultQuery(): array
    {
        return array_filter($this->queryParams, fn ($value) => $value !== null);
    }
}
