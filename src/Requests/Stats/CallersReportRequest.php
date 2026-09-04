<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class CallersReportRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'callers-report';
    }
}
