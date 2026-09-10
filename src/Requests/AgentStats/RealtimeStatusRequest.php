<?php

namespace CXEngine\ExpertStats\Requests\AgentStats;

class RealtimeStatusRequest extends AgentStatsRequest
{
    protected function path(): string
    {
        return 'realtime-status';
    }
}
