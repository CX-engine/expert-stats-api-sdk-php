<?php

namespace CXEngine\ExpertStats\Requests\ResourceGroup;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteResourceGroupRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected readonly string $hostName,
        protected readonly int $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1.2/' . $this->hostName . '/resource-groups/' . $this->id;
    }
}
