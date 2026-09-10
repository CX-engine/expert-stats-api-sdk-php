<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\Ai\Chat as Chat;
use CXEngine\ExpertStats\Requests\Ai\Alerts as Alerts;
use CXEngine\ExpertStats\Requests\Ai\Reports as Reports;
use CXEngine\ExpertStats\Requests\Ai\Dashboard as Dashboard;
use CXEngine\ExpertStats\Requests\Ai\Analytics as Analytics;

/**
 * Wraps the `/v1.2/{hostName}/ai/...` endpoints (chat, scheduled reports,
 * pre-computed analytics, alerts, and the AI dashboard).
 */
class AiResource extends Resource
{
    // --- Chat ---

    public function chat(string $hostName, string $message, ?string $conversationUuid = null): Response
    {
        return $this->connector->send(
            new Chat\ChatRequest($hostName, $message, $conversationUuid)
        );
    }

    public function chatHistory(string $hostName): Response
    {
        return $this->connector->send(
            new Chat\ChatHistoryRequest($hostName)
        );
    }

    public function showChatHistory(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Chat\ShowChatHistoryRequest($hostName, $uuid)
        );
    }

    public function deleteChatHistory(string $hostName): Response
    {
        return $this->connector->send(
            new Chat\DeleteChatHistoryRequest($hostName)
        );
    }

    public function usage(string $hostName): Response
    {
        return $this->connector->send(
            new Chat\UsageRequest($hostName)
        );
    }

    // --- Reports ---

    public function reports(string $hostName): Response
    {
        return $this->connector->send(
            new Reports\IndexReportsRequest($hostName)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function storeReport(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Reports\StoreReportRequest($hostName, $data)
        );
    }

    public function showReport(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Reports\ShowReportRequest($hostName, $uuid)
        );
    }

    public function deleteReport(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Reports\DeleteReportRequest($hostName, $uuid)
        );
    }

    public function sendReport(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Reports\SendReportRequest($hostName, $uuid)
        );
    }

    // --- Analytics ---

    /**
     * @param  array<string, mixed>  $query
     */
    public function analyticsCallLoss(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Analytics\CallLossRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function analyticsPeakHours(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Analytics\PeakHoursRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function analyticsPeriodComparison(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Analytics\PeriodComparisonRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function analyticsAgentPerformance(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Analytics\AgentPerformanceRequest($hostName, $query)
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function analyticsAgentStatus(string $hostName, array $query = []): Response
    {
        return $this->connector->send(
            new Analytics\AgentStatusRequest($hostName, $query)
        );
    }

    // --- Alerts ---

    public function alerts(string $hostName): Response
    {
        return $this->connector->send(
            new Alerts\IndexAlertsRequest($hostName)
        );
    }

    public function checkAlertsNow(string $hostName): Response
    {
        return $this->connector->send(
            new Alerts\CheckAlertsNowRequest($hostName)
        );
    }

    public function dismissAlert(string $hostName, int $alert): Response
    {
        return $this->connector->send(
            new Alerts\DismissAlertRequest($hostName, $alert)
        );
    }

    public function alertSettings(string $hostName): Response
    {
        return $this->connector->send(
            new Alerts\AlertSettingsRequest($hostName)
        );
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function updateAlertSettings(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Alerts\UpdateAlertSettingsRequest($hostName, $data)
        );
    }

    // --- Dashboard ---

    public function dashboard(string $hostName): Response
    {
        return $this->connector->send(
            new Dashboard\DashboardRequest($hostName)
        );
    }

    public function refreshDashboard(string $hostName): Response
    {
        return $this->connector->send(
            new Dashboard\RefreshDashboardRequest($hostName)
        );
    }

    public function readAllInsights(string $hostName): Response
    {
        return $this->connector->send(
            new Dashboard\ReadAllInsightsRequest($hostName)
        );
    }

    public function readInsight(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Dashboard\ReadInsightRequest($hostName, $uuid)
        );
    }

    public function dismissInsight(string $hostName, string $uuid): Response
    {
        return $this->connector->send(
            new Dashboard\DismissInsightRequest($hostName, $uuid)
        );
    }
}
