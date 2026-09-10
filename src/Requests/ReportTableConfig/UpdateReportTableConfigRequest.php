<?php

namespace CXEngine\ExpertStats\Requests\ReportTableConfig;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class UpdateReportTableConfigRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly string $customer,
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-report-table-configurations/' . $this->customer;
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
