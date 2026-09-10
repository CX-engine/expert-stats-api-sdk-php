<?php

namespace CXEngine\ExpertStats\Requests\Stats;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Streams a binary file export - the response must NOT be `->json()`'d by
 * callers, see {@see \CXEngine\ExpertStats\Resources\StatsResource::getDidReportFile()}.
 */
class DidReportFileRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/did-report-file';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
