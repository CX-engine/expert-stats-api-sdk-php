<?php

namespace CXEngine\ExpertStats\Requests\Pbx3cxHosts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeletePbx3cxHostRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-hosts/' . $this->hostName;
    }

    public function __construct(
        protected string $hostName,
    ) {
        //
    }
}
