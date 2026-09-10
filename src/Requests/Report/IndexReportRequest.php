<?php

namespace CXEngine\ExpertStats\Requests\Report;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class IndexReportRequest extends Request
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
        return '/v1.2/' . $this->hostName . '/reports';
    }

    protected function defaultQuery(): array
    {
        return array_filter($this->queryParams, fn ($value) => $value !== null);
    }
}
