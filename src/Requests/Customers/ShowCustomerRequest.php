<?php

namespace CXEngine\ExpertStats\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use CXEngine\ExpertStats\Entities\Customer;

class ShowCustomerRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/customers/' . $this->customerCode;
    }

    public function __construct(
        protected string $customerCode,
    ) {
        //
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Customer::fromResponse($response);
    }
}
