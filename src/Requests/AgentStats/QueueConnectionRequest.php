<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class QueueConnectionRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'queue-connection';
    }
}
