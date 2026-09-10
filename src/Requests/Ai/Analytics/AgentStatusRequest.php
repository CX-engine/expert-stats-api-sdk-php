<?php

namespace CXEngine\ExpertStats\Requests\Ai\Analytics;

class AgentStatusRequest extends AnalyticsRequest
{
    protected function path(): string
    {
        return 'analytics/agent-status';
    }
}
