<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class QueueCoverageRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'queue-coverage';
    }
}
