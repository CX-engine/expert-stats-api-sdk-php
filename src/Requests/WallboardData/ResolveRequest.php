<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class ResolveRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $tiles
     */
    public function __construct(
        protected readonly string $hostName,
        protected readonly array $tiles,
        protected readonly bool $aggregated = false,
    ) {
    }

    public function resolveEndpoint(): string
    {
        $segment = $this->aggregated ? 'wallboard-aggregated' : 'wallboard';

        return "/v1.2/{$this->hostName}/{$segment}/resolve";
    }

    protected function defaultBody(): array
    {
        // The backend expects the tile list wrapped in a `tiles` field (see
        // WallboardMetaController::resolve / WallboardAggregatedController::resolve).
        return ['tiles' => $this->tiles];
    }
}
