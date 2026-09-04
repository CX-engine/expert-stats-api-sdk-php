<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class DidReportRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'did-report';
    }
}
