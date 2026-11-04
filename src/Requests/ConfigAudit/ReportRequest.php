<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

class ReportRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'report';
    }
}
