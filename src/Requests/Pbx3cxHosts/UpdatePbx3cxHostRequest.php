<?php

namespace CXEngine\ExpertStats\Requests\Pbx3cxHosts;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Arr;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Entities\Pbx3cxHost;
use CXEngine\ExpertStats\Exceptions\EntityIdMissingException;

class UpdatePbx3cxHostRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-hosts/' . $this->host->host_name;
    }

    public function __construct(
        protected Pbx3cxHost $host,
    ) {
        if (!$this->host->code) {
            throw new EntityIdMissingException('Entity must have an ID to be updated.');
        }
    }

    protected function defaultBody(): array
    {
        return Arr::except(
            $this->host->toArray(),
            ['code', 'pbx_map', 'created_at', 'updated_at']
        );
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Pbx3cxHost::fromResponse($response);
    }
}
