<?php

namespace CXEngine\ExpertStats\Requests\AiHelper;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Dry-run validation for a Pbx3cxReport payload — never persists anything,
 * see AiHelperReportController::validateRequest() on the backend.
 */
class ValidateReportRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $data,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/'.$this->hostName.'/ai-helper/reports/validate';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
