<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

class AgentsRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'agents';
    }
}
