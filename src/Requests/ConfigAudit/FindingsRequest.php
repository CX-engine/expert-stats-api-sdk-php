<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

class FindingsRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'findings';
    }
}
