<?php

namespace CXEngine\ExpertStats\Requests\Pbx3cxHosts;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use CXEngine\ExpertStats\Entities\Pbx3cxHost;

class ShowPbx3cxHostRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-hosts/' . $this->hostName;
    }

    public function __construct(
        protected string $hostName,
    ) {
        //
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Pbx3cxHost::fromResponse($response);
    }
}
