<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

/**
 * Findings marked as expected for the host.
 */
class AcceptancesRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'acceptances';
    }
}
