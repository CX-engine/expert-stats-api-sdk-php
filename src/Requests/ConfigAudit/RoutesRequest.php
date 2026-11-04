<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

class RoutesRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'routes';
    }
}
