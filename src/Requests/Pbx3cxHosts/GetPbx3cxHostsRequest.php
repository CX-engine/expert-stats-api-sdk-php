<?php

namespace CXEngine\ExpertStats\Requests\Pbx3cxHosts;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use CXEngine\ExpertStats\EntityCollection;
use CXEngine\ExpertStats\Entities\Pbx3cxHost;

class GetPbx3cxHostsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-hosts';
    }

    public function createDtoFromResponse(Response $response): EntityCollection
    {
        return EntityCollection::fromResponse($response, Pbx3cxHost::class, 'data');
    }
}
