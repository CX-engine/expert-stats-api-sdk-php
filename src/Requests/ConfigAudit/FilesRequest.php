<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

/**
 * Files provided for the audit of the host (backup XMLs, Call Flow sources,
 * prompts) and the Call Flow Apps sources can be given for.
 */
class FilesRequest extends ConfigAuditRequest
{
    protected function path(): string
    {
        return 'files';
    }
}
