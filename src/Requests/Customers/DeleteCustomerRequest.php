<?php

namespace CXEngine\ExpertStats\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteCustomerRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return '/v1.2/customers/' . $this->customerCode;
    }

    public function __construct(
        protected string $customerCode,
    ) {
        //
    }
}
