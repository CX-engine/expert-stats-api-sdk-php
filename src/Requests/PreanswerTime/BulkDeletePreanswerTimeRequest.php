<?php

namespace CXEngine\ExpertStats\Requests\PreanswerTime;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class BulkDeletePreanswerTimeRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::DELETE;

    /**
     * @param  array<int, int>  $ids
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $ids,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/preanswer-times/bulk';
    }

    protected function defaultBody(): array
    {
        // The backend expects the id list wrapped in an `ids` field (see
        // Pbx3cxQueuePreanswerTimeController::bulkDestroy).
        return ['ids' => $this->ids];
    }
}
