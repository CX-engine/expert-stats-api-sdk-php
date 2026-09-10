<?php

namespace CXEngine\ExpertStats\Requests\Cdr;

use CXEngine\ExpertStats\Requests\Stats\HostScopedStatsRequest;

class CdrReportRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'cdr-report';
    }
}
