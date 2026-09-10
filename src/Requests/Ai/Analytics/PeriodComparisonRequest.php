<?php

namespace CXEngine\ExpertStats\Requests\Ai\Analytics;

class PeriodComparisonRequest extends AnalyticsRequest
{
    protected function path(): string
    {
        return 'analytics/period-comparison';
    }
}
