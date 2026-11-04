<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

use Saloon\Enums\Method;

/**
 * Removes the Call Flow Designer sources provided for one Call Flow App.
 */
class DeleteCallFlowRequest extends ConfigAuditRequest
{
    protected Method $method = Method::DELETE;

    public function __construct(string $hostName, protected readonly string $app)
    {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'files/call-flows/'.rawurlencode($this->app);
    }
}
