<?php

namespace CXEngine\ExpertStats\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Arr;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Entities\Customer;
use CXEngine\ExpertStats\Exceptions\EntityIdMissingException;

class UpdateCustomerRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return '/v1.2/customers/' . $this->customer->code;
    }

    public function __construct(
        protected Customer $customer,
    ) {
        if (!$this->customer->code) {
            throw new EntityIdMissingException('Entity must have an ID to be updated.');
        }
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
