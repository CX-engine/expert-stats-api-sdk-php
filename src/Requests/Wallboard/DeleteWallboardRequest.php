<?php

namespace CXEngine\ExpertStats\Requests\Wallboard;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteWallboardRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected readonly string $hostName,
        protected readonly string $uuid,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/wallboards/' . $this->uuid;
    }
}
