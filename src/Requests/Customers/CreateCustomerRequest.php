<?php

namespace CXEngine\ExpertStats\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Arr;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Entities\Customer;

class CreateCustomerRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/v1.2/customers';
    }

    public function __construct(
        protected Customer $customer,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        return Arr::except(
            $this->customer->toArray(),
            ['code', 'created_at', 'updated_at']
        );
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Customer::fromResponse($response);
    }
}
