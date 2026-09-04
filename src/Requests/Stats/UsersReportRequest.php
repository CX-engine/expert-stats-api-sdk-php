<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class UsersReportRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'users-report-aggregated';
    }
}
