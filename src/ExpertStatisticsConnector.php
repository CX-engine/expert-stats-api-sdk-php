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
    // use HasRateLimits;

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
            Limit::allow(requests: 1000, threshold: 0.9)->everyMinute()->sleep(),
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
            protected ?int $perPageLimit = 40;

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

    public function customer(): Resources\CustomerResource
    {
        return new Resources\CustomerResource($this);
    }

    public function pbx3cxHost(): Resources\Pbx3cxHostResource
    {
        return new Resources\Pbx3cxHostResource($this);
    }

    public function pbx3cxCall(): Resources\Pbx3cxCallResource
    {
        return new Resources\Pbx3cxCallResource($this);
    }

    public function stats(): Resources\StatsResource
    {
        return new Resources\StatsResource($this);
    }

    public function reportTableConfig(): Resources\ReportTableConfigResource
    {
        return new Resources\ReportTableConfigResource($this);
    }

    public function agentConfiguration(): Resources\AgentConfigurationResource
    {
        return new Resources\AgentConfigurationResource($this);
    }

    public function preanswerTime(): Resources\PreanswerTimeResource
    {
        return new Resources\PreanswerTimeResource($this);
    }

    public function resourceGroup(): Resources\ResourceGroupResource
    {
        return new Resources\ResourceGroupResource($this);
    }

    public function hostAudit(): Resources\HostAuditResource
    {
        return new Resources\HostAuditResource($this);
    }

    public function hostNote(): Resources\HostNoteResource
    {
        return new Resources\HostNoteResource($this);
    }

    public function cdr(): Resources\CdrResource
    {
        return new Resources\CdrResource($this);
    }

    public function report(): Resources\ReportResource
    {
        return new Resources\ReportResource($this);
    }

    public function alert(): Resources\AlertResource
    {
        return new Resources\AlertResource($this);
    }

    public function wallboard(): Resources\WallboardResource
    {
        return new Resources\WallboardResource($this);
    }

    public function wallboardData(): Resources\WallboardDataResource
    {
        return new Resources\WallboardDataResource($this);
    }

    public function agentStats(): Resources\AgentStatsResource
    {
        return new Resources\AgentStatsResource($this);
    }

    public function ai(): Resources\AiResource
    {
        return new Resources\AiResource($this);
    }

    public function aiHelper(): Resources\AiHelperResource
    {
        return new Resources\AiHelperResource($this);
    }

    public function training(): Resources\TrainingResource
    {
        return new Resources\TrainingResource($this);
    }
}
