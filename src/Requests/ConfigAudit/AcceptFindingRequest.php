<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Marks a finding of the latest audit as expected for the host: it leaves
 * the score and the recommendations of this audit and of the next ones.
 */
class AcceptFindingRequest extends ConfigAuditRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array{finding: string, note?: ?string, accepted_by?: ?string}  $data
     */
    public function __construct(string $hostName, protected readonly array $data)
    {
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return 'acceptances';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
