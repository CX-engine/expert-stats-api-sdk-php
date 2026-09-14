<?php

namespace CXEngine\ExpertStats\Requests\Report;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteReportRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected readonly string $hostName,
        protected readonly string $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/reports/' . $this->id;
    }
}
