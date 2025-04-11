<?php

namespace CXEngine\ExpertStats\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use CXEngine\ExpertStats\Entities\Customer;

class ShowCustomerFromOriginRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/customer-from-origin/' . $this->tenantCode . '/' . $this->tenantReference;
    }

    public function __construct(
        protected string $tenantCode,
        protected string $tenantReference,
    ) {
        //
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Customer::fromResponse($response);
    }
}
