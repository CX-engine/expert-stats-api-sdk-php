<?php

namespace CXEngine\ExpertStats\Requests\HostAudit;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ShowHostAuditRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $hostName,
        protected readonly int $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/pbx3cx-audits/' . $this->id;
    }
}
