<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class StatusBreakdownRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'status-breakdown';
    }
}
