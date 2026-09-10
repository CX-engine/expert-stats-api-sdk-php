<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class HasDataLiveRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'has-data-live';
    }
}
