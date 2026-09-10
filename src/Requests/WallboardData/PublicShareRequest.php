<?php

namespace CXEngine\ExpertStats\Requests\WallboardData;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * The public share endpoint - not host-scoped at all, just the share key.
 */
class PublicShareRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $key,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/wallboard/view/' . $this->key;
    }
}
