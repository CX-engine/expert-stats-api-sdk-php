<?php

namespace CXEngine\ExpertStats\Requests\Stats;

class TrendMonthlyRequest extends HostScopedStatsRequest
{
    protected function path(): string
    {
        return 'trend-monthly';
    }
}
