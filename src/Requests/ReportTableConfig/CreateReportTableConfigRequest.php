<?php

namespace CXEngine\ExpertStats\Requests\ReportTableConfig;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class CreateReportTableConfigRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-report-table-configurations';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
