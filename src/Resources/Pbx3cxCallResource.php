<?php

namespace CXEngine\ExpertStats\Resources;

use Carbon\Carbon;
use Saloon\Http\Response;
use CXEngine\ExpertStats\Entities\Pbx3cxCall;
use CXEngine\ExpertStats\Requests\Pbx3cxCalls as Endpoints;

class Pbx3cxCallResource extends Resource
{
    public function index(
        string $hostName,
        Carbon $start,
        Carbon $end,
    ): Response {
        return $this->connector->send(
            new Endpoints\GetPbx3cxCallsRequest(
                hostName: $hostName,
                start: $start,
                end: $end,
            )
        );
    }

    public function show(
        string $hostName,
        string $callId,
    ): Response {
        return $this->connector->send(
            new Endpoints\ShowPbx3cxCallRequest(
                hostName: $hostName,
                callId: $callId,
            )
        );
    }

    // public function store(Pbx3cxHost $host): Response
    // {
    //     return $this->connector->send(
    //         new Endpoints\CreatePbx3cxHostRequest($host)
    //     );
    // }

    // public function update(Pbx3cxHost $host): Response
    // {
    //     return $this->connector->send(
    //         new Endpoints\UpdatePbx3cxHostRequest($host)
    //     );
    // }

    // public function upsert(Pbx3cxHost $host): Response
    // {
    //     return $host->code
    //         ? $this->update($host)
    //         : $this->store($host);
    // }

    // public function delete(string $hostName): Response
    // {
    //     return $this->connector->send(
    //         new Endpoints\DeletePbx3cxHostRequest($hostName)
    //     );
    // }
}
