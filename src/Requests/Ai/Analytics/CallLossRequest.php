<?php

namespace CXEngine\ExpertStats\Requests\Ai\Analytics;

class CallLossRequest extends AnalyticsRequest
{
    protected function path(): string
    {
        return 'analytics/call-loss';
    }
}
