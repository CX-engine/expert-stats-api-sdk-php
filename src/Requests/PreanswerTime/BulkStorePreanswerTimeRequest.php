<?php

namespace CXEngine\ExpertStats\Requests\PreanswerTime;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class BulkStorePreanswerTimeRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $items,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/preanswer-times/bulk';
    }

    protected function defaultBody(): array
    {
        // The backend expects the list wrapped in a `configs` field (see
        // Pbx3cxQueuePreanswerTimeController::bulkStore).
        return ['configs' => $this->items];
    }
}
