<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\ConfigAudit as ConfigAudit;

/**
 * Wraps the `/v1.2/{hostName}/config-audit/...` endpoints: audit of the 3CX
 * configuration from the host's backup, crossed with its call statistics,
 * with a configuration score and recommendations.
 *
 * Every read accepts an optional period: ['start_date' => 'Y-m-d', 'end_date' => 'Y-m-d']
 * (default: last 30 days). The server answers 404 when no audit exists yet
 * and 403 when the AI features are not activated for the host.
 */
class ConfigAuditResource extends Resource
{
    /**
     * Score, area scores, coverage, counts, top recommendations and trend.
     *
     * @param  array<string, mixed>  $query  start_date, end_date
     */
    public function summary(string $hostName, array $query = []): Response
    {
        return $this->connector->send(new ConfigAudit\SummaryRequest($hostName, $query));
    }

    /**
     * Recommendations, most costly for the score first.
     *
     * @param  array<string, mixed>  $query  category[], code[], area[], object, did, search, page, per_page, start_date, end_date
     */
    public function findings(string $hostName, array $query = []): Response
    {
        return $this->connector->send(new ConfigAudit\FindingsRequest($hostName, $query));
    }

    /**
     * DIDs with their first destination, calls and number of findings.
     *
     * @param  array<string, mixed>  $query  search, page, per_page, start_date, end_date
     */
    public function routes(string $hostName, array $query = []): Response
    {
        return $this->connector->send(new ConfigAudit\RoutesRequest($hostName, $query));
    }

    /**
     * Full routing of one DID with its findings.
     *
     * @param  array<string, mixed>  $query  start_date, end_date
     */
    public function route(string $hostName, string $did, array $query = []): Response
    {
        return $this->connector->send(new ConfigAudit\ShowRouteRequest($hostName, $did, $query));
    }

    /**
     * Queue configuration with agents, statistics and findings.
     *
     * @param  array<string, mixed>  $query  start_date, end_date
     */
    public function queues(string $hostName, array $query = []): Response
    {
        return $this->connector->send(new ConfigAudit\QueuesRequest($hostName, $query));
    }

    /**
     * Queue agents with their queues, statistics and findings.
     *
     * @param  array<string, mixed>  $query  search, page, per_page, start_date, end_date
     */
    public function agents(string $hostName, array $query = []): Response
    {
        return $this->connector->send(new ConfigAudit\AgentsRequest($hostName, $query));
    }

    /**
     * Past audits and their scores.
     *
     * @param  array<string, mixed>  $query  limit
     */
    public function history(string $hostName, array $query = []): Response
    {
        return $this->connector->send(new ConfigAudit\HistoryRequest($hostName, $query));
    }

    /**
     * Human report of the latest audit (text/markdown body).
     */
    public function report(string $hostName): Response
    {
        return $this->connector->send(new ConfigAudit\ReportRequest($hostName));
    }

    /**
     * Re-run the audit on the latest backup and re-evaluate the score.
     */
    public function refresh(string $hostName): Response
    {
        return $this->connector->send(new ConfigAudit\RefreshRequest($hostName));
    }

    /**
     * Findings marked as expected for the host.
     */
    public function acceptances(string $hostName): Response
    {
        return $this->connector->send(new ConfigAudit\AcceptancesRequest($hostName));
    }

    /**
     * Mark a finding (id or "code:object" key) as expected for the host.
     *
     * @param  array{finding: string, note?: ?string, accepted_by?: ?string}  $data
     */
    public function accept(string $hostName, array $data): Response
    {
        return $this->connector->send(new ConfigAudit\AcceptFindingRequest($hostName, $data));
    }

    /**
     * Report an accepted finding again.
     */
    public function revokeAcceptance(string $hostName, int $acceptanceId): Response
    {
        return $this->connector->send(new ConfigAudit\RevokeAcceptanceRequest($hostName, $acceptanceId));
    }

    /**
     * Files provided for the audit and the Call Flow Apps sources can be given for.
     */
    public function files(string $hostName): Response
    {
        return $this->connector->send(new ConfigAudit\FilesRequest($hostName));
    }

    /**
     * Upload a file for the audit: kind backup (XML), call_flow (ZIP, fields
     * app and uploaded_by) or prompts (ZIP of .wav).
     *
     * @param  array<string, string|null>  $fields
     */
    public function uploadFile(string $hostName, string $kind, string $path, string $fileName, array $fields = []): Response
    {
        return $this->connector->send(new ConfigAudit\UploadFileRequest($hostName, $kind, $path, $fileName, $fields));
    }

    public function deleteCallFlow(string $hostName, string $app): Response
    {
        return $this->connector->send(new ConfigAudit\DeleteCallFlowRequest($hostName, $app));
    }
}
