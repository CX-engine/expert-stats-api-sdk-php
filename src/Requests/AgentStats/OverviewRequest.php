<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class OverviewRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'overview';
    }
}
