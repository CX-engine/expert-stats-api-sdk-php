<?php

namespace CXEngine\ExpertStats\Resources;

use Saloon\Http\Response;
use CXEngine\ExpertStats\Entities\Customer;
use CXEngine\ExpertStats\Entities\Pbx3cxHost;
use CXEngine\ExpertStats\Requests;

class CustomerResource extends Resource
{
    public function index(): Response
    {
        return $this->connector->send(
            new Requests\Customers\GetCustomersRequest()
        );
    }

    public function show(string $customerCode): Response
    {
        return $this->connector->send(
            new Requests\Customers\ShowCustomerRequest($customerCode)
        );
    }

    public function store(Customer $customer): Response
    {
        return $this->connector->send(
            new Requests\Customers\CreateCustomerRequest($customer)
        );
    }

    public function update(Customer $customer): Response
    {
        return $this->connector->send(
            new Requests\Customers\UpdateCustomerRequest($customer)
        );
    }

    public function upsert(Customer $customer): Response
    {
        return $customer->code
            ? $this->update($customer)
            : $this->store($customer);
    }

    public function delete(string $customerCode): Response
    {
        return $this->connector->send(
            new Requests\Customers\DeleteCustomerRequest($customerCode)
        );
    }

    public function showFromOrigin(string $tenantCode, string $tenantReference): Response
    {
        return $this->connector->send(
            new Requests\Customers\ShowCustomerFromOriginRequest($tenantCode, $tenantReference)
        );
    }

    public function getHosts(Customer $customer): Response
    {
        return $this->connector->send(
            new Requests\CustomerPbx3cxHost\GetCustomerHostsRequest($customer)
        );
    }

    public function attachHost(Customer $customer, Pbx3cxHost $host): Response
    {
        return $this->connector->send(
            new Requests\CustomerPbx3cxHost\AttachCustomerHostRequest($customer, $host)
        );
    }

    public function detachHost(Customer $customer, Pbx3cxHost $host): Response
    {
        return $this->connector->send(
            new Requests\CustomerPbx3cxHost\DetachCustomerHostRequest($customer, $host)
        );
    }
}
