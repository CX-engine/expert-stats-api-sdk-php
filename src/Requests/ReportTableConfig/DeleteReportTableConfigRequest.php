<?php

namespace CXEngine\ExpertStats\Requests\ReportTableConfig;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteReportTableConfigRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected readonly int $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-report-table-configurations/' . $this->id;
    }
}
