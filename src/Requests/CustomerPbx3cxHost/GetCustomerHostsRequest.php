<?php

namespace CXEngine\ExpertStats\Requests\CustomerPbx3cxHost;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use CXEngine\ExpertStats\Entities\Customer;
use CXEngine\ExpertStats\Entities\Pbx3cxHost;

class GetCustomerHostsRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/v1.2/customer-pbx3cx-host';
    }

    public function __construct(
        protected Customer $customer,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        return [
            'customer_code' => $this->customer->code,
        ];
    }
}
