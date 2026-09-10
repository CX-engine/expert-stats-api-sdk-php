<?php

namespace CXEngine\ExpertStats\Requests\Ai\Analytics;

class AgentPerformanceRequest extends AnalyticsRequest
{
    protected function path(): string
    {
        return 'analytics/agent-performance';
    }
}
