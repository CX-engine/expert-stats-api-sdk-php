<?php

namespace CXEngine\ExpertStats\Requests\Pbx3cxCalls;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use CXEngine\ExpertStats\EntityCollection;
use CXEngine\ExpertStats\Entities\Pbx3cxCall;

class GetPbx3cxCallsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/calls';
    }

    public function __construct(
        protected string $hostName,
        protected ?string $timekey = null,
    ) {
        //
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'timekey' => $this->timekey,
        ]);
    }

    public function createDtoFromResponse(Response $response): EntityCollection
    {
        return EntityCollection::fromResponse($response, Pbx3cxCall::class, null);
    }
}
