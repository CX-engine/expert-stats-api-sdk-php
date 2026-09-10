<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class HasDataRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'has-data';
    }
}
