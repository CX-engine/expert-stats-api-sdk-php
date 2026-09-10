<?php

namespace CXEngine\ExpertStats\Requests\Cdr;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Streams a binary CSV export - the response must NOT be `->json()`'d by
 * callers, see {@see \CXEngine\ExpertStats\Resources\CdrResource::getHostReportFile()}.
 */
class HostReportFileRequest extends Request implements HasBody
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
        return '/v1.2/' . $this->hostName . '/host-report-file';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
