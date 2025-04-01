<?php

namespace CXEngine\ExpertStats\Requests\Pbx3cxCalls;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use CXEngine\ExpertStats\EntityCollection;
use CXEngine\ExpertStats\Entities\Pbx3cxCall;

class ShowPbx3cxCallRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/call';
    }

    public function __construct(
        protected string $hostName,
        protected ?string $callId = null,
    ) {
        //
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'call_id' => $this->callId,
        ]);
    }

    public function createDtoFromResponse(Response $response): EntityCollection
    {
        return EntityCollection::fromResponse($response, Pbx3cxCall::class, null);
    }
}
