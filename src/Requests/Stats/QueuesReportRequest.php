<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class QueuesReportRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'queues-report-aggregated';
    }
}
