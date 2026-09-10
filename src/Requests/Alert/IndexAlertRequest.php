<?php

namespace CXEngine\ExpertStats\Requests\Alert;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class IndexAlertRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $hostName,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/alerts';
    }
}
