<?php

namespace CXEngine\ExpertStats;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Http\Connector;
use Saloon\Http\PendingRequest;
use Saloon\RateLimitPlugin\Limit;
use CXEngine\ExpertStats\Resources;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\PaginationPlugin\PagedPaginator;
use CXEngine\ExpertStats\Requests\AuthRequest;
use Saloon\RateLimitPlugin\Stores\MemoryStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use CXEngine\ExpertStats\Exceptions\AuthenticationException;

class ExpertStatisticsConnector extends Connector implements HasPagination
{
    use HasRateLimits;

    protected string $apiToken;
    protected array $apiUser;

    public function __construct(
        protected string $apiUrl,
        #[\SensitiveParameter]
        protected string $email,
        #[\SensitiveParameter]
        protected string $password,
        protected ?string $tenantCode = null,
    ) {
    }

    public function getTenantCode(): ?string
    {
        return $this->tenantCode;
    }

    public function setTenantCode(string $tenantCode): self
    {
        $this->tenantCode = $tenantCode;

        return $this;
    }

    public function boot(PendingRequest $pendingRequest): void
    {
        $this->authenticatePendingRequest($pendingRequest);
    }

    public function resolveBaseUrl(): string
    {
        return $this->apiUrl;
    }

    protected function setAccessToken()
    {
        $response = $this->send(
            new AuthRequest($this->email, $this->password)
        );

        if ($response->failed()) {
            throw new AuthenticationException(
                'Failed to authenticate with Expert Statistics API. Please check your credentials.'
            );
        }

        $body = $response->json();

        $this->apiUser = $body['user'];
        $this->apiToken = $body['token'];
    }

    protected function authenticatePendingRequest(PendingRequest $pendingRequest): void
    {
        if (get_class($pendingRequest->getRequest()) === AuthRequest::class) {
            return;
        }

        if ($pendingRequest->hasMockClient()) {
            return;
        }

        if (!isset($this->apiToken)) {
            $this->setAccessToken();
        }

        $pendingRequest->authenticate(new TokenAuthenticator($this->apiToken));
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(requests: 500, threshold: 0.9)->everyMinute()->sleep(),
        ];
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new MemoryStore;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function defaultConfig(): array
    {
        return [
            'timeout' => 60,
        ];
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator {
            protected ?int $perPageLimit = 20;

            protected function isLastPage(Response $response): bool
            {
                return is_null($response->json('next_page_url'));
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dto()->all();
            }
        };
    }

    public function pbx3cxHost(): Resources\Pbx3cxHostResource
    {
        return new Resources\Pbx3cxHostResource($this);
    }

    public function pbx3cxCall(): Resources\Pbx3cxCallResource
    {
        return new Resources\Pbx3cxCallResource($this);
    }
}
