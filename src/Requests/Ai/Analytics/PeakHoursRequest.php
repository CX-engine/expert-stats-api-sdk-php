<?php

namespace CXEngine\ExpertStats\Requests\Ai\Analytics;

class PeakHoursRequest extends AnalyticsRequest
{
    protected function path(): string
    {
        return 'analytics/peak-hours';
    }
}
