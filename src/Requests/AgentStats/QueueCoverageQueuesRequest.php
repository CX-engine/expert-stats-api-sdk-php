<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class QueueCoverageQueuesRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'queue-coverage/queues';
    }
}
