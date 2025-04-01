<?php

namespace CXEngine\ExpertStats\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use CXEngine\ExpertStats\EntityCollection;
use CXEngine\ExpertStats\Entities\Customer;

class GetCustomersRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/customers';
    }

    public function createDtoFromResponse(Response $response): EntityCollection
    {
        return EntityCollection::fromResponse($response, Customer::class);
    }
}
