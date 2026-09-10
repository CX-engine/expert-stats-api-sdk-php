<?php

namespace CXEngine\ExpertStats\Requests\ReportTableConfig;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ShowReportTableConfigRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $customer,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-report-table-configurations/' . $this->customer;
    }
}
