<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

class QueuesRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'queues';
    }
}
