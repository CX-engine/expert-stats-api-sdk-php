<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Entities\Customer;
use CXEngine\ExpertStats\Entities\Pbx3cxHost;
use CXEngine\ExpertStats\Requests\Pbx3cxHosts as Endpoints;
use CXEngine\ExpertStats\Requests\CustomerPbx3cxHost\AttachCustomerHostRequest;
use CXEngine\ExpertStats\Requests\CustomerPbx3cxHost\DetachCustomerHostRequest;

class Pbx3cxHostResource extends Resource
{
    public function index(): Response
    {
        return $this->connector->send(
            new Endpoints\GetPbx3cxHostsRequest()
        );
    }

    public function show(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\ShowPbx3cxHostRequest($hostName)
        );
    }

    public function store(Pbx3cxHost $host): Response
    {
        return $this->connector->send(
            new Endpoints\CreatePbx3cxHostRequest($host)
        );
    }

    public function update(Pbx3cxHost $host): Response
    {
        return $this->connector->send(
            new Endpoints\UpdatePbx3cxHostRequest($host)
        );
    }

    public function upsert(Pbx3cxHost $host): Response
    {
        return $host->code
            ? $this->update($host)
            : $this->store($host);
    }

    public function delete(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\DeletePbx3cxHostRequest($hostName)
        );
    }

    public function showMap(string $hostName): Response
    {
        return $this->connector->send(
            new Endpoints\ShowPbx3cxHostMapRequest($hostName)
        );
    }

    public function attachCustomer(Customer $customer, Pbx3cxHost $host): Response
    {
        return $this->connector->send(
            new AttachCustomerHostRequest($customer, $host)
        );
    }

    public function detachCustomer(Customer $customer, Pbx3cxHost $host): Response
    {
        return $this->connector->send(
            new DetachCustomerHostRequest($customer, $host)
        );
    }
}
