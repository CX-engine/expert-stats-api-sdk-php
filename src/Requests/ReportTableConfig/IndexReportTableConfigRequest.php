<?php

namespace CXEngine\ExpertStats\Requests\ReportTableConfig;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class IndexReportTableConfigRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1.2/pbx3cx-report-table-configurations';
    }
}
