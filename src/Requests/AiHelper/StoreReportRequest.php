<?php

namespace CXEngine\ExpertStats\Requests\AiHelper;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Creates (and, per AiHelperReportController::store(), possibly immediately
 * emails) a Pbx3cxReport. The backend re-validates and checks the host's
 * `ai_activated` flag before persisting — this request never bypasses that.
 */
class StoreReportRequest extends Request implements HasBody
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
        return '/v1.2/'.$this->hostName.'/ai-helper/reports';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
