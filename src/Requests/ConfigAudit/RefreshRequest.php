<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

use Saloon\Enums\Method;

/**
 * Re-runs the audit on the host's latest backup and re-evaluates its score.
 */
class RefreshRequest extends ConfigAuditRequest
{
    protected Method $method = Method::POST;

    protected function path(): string
    {
        return 'refresh';
    }
}
