<?php

namespace CXEngine\ExpertStats\Requests\Ai;

use Saloon\Http\Request;

/**
 * Base class for the host-scoped `/v1.2/{hostName}/ai/...` endpoints. Unlike
 * {@see \CXEngine\ExpertStats\Requests\Stats\HostScopedStatsRequest}, the AI
 * endpoints are a mix of GET/POST/DELETE, so this base does not hardcode the
 * HTTP method — concrete subclasses set their own `$method`. Only the
 * endpoint-resolution logic is shared.
 */
abstract class AiRequest extends Request
{
    public function __construct(
        protected readonly string $hostName,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/v1.2/{$this->hostName}/ai/{$this->path()}";
    }

    abstract protected function path(): string;
}
