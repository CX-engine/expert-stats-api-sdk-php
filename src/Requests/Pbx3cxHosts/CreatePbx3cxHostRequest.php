<?php

namespace CXEngine\ExpertStats\Requests\Pbx3cxHosts;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Arr;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Entities\Pbx3cxHost;

class CreatePbx3cxHostRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-hosts';
    }

    public function __construct(
        protected Pbx3cxHost $host,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        return Arr::except(
            $this->host->toArray(),
            ['code', 'pbx_map', 'customers', 'created_at', 'updated_at']
        );
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Pbx3cxHost::fromResponse($response);
    }
}
