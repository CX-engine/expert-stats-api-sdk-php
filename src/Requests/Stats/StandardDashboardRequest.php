<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class StandardDashboardRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'standard-dashboard';
    }
}
