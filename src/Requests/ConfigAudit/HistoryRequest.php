<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

class HistoryRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'history';
    }
}
