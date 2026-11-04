<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

use Saloon\Enums\Method;

/**
 * Reports an accepted finding again.
 */
class RevokeAcceptanceRequest extends ConfigAuditRequest
{
    protected Method $method = Method::DELETE;

    public function __construct(string $hostName, protected readonly int $acceptanceId)
    {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return "acceptances/{$this->acceptanceId}";
    }
}
