<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Requests\Training as Endpoints;

/**
 * Wraps `/v1.2/{hostName}/trainings/...` — the Expert Statistics training
 * (cx-engine/expert-statistics package's Training page). Every call after
 * store() is authenticated by the emailed training key + email, passed in
 * `$data` as `key`/`email`.
 */
class TrainingResource extends Resource
{
    /**
     * @param  array{email: string, tenant_id: string, tenant_name?: string|null, tenant_code?: string|null, locale?: string|null, training_url?: string|null}  $data
     */
    public function store(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StoreTrainingRequest($hostName, $data)
        );
    }

    /**
     * @param  array{email: string, key: string, locale?: string|null}  $data
     */
    public function start(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\StartTrainingRequest($hostName, $data)
        );
    }

    /**
     * @param  array{email: string, key: string, answers: array<int, array{question_id: int, option_id: int}>}  $data
     */
    public function saveAnswers(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\SaveTrainingAnswersRequest($hostName, $data)
        );
    }

    /**
     * @param  array{email: string, key: string}  $data
     */
    public function complete(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\CompleteTrainingRequest($hostName, $data)
        );
    }

    /**
     * @param  array{email: string, key: string}  $data
     */
    public function summary(string $hostName, array $data): Response
    {
        return $this->connector->send(
            new Endpoints\ShowTrainingSummaryRequest($hostName, $data)
        );
    }
}
