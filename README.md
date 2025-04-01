# Expert statistics PHP Client

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/CX-engine/expert-stats-api-sdk-php.svg?style=flat-square)](https://packagist.org/packages/CX-engine/expert-stats-api-sdk-php)
[![Total Downloads](https://img.shields.io/packagist/dt/CX-engine/expert-stats-api-sdk-php.svg?style=flat-square)](https://packagist.org/packages/CX-engine/expert-stats-api-sdk-php)


This package is a light PHP Wrapper / SDK for the Expert Stats API.

- [Installation](#installation)
- [Authentication](#authentication)
  - [Client Code Grant](#authentication-client-code-grant)
  - [Password Grant](#authentication-password-grant)
- [Usage](#usage)
  - [Requests](#usage-requests)
  - [Resources](#usage-resources)
  - [Responses](#usage-responses)
  - [Entities](#usage-entities)
  - [Pagination](#usage-pagination)
  - [Extending the SDK](#usage-extends)


<a name="installation"></a>

## Installation

This library requires PHP `>=8.2`.

You can install the package via composer:

```
composer require cx-engine/expert-stats-api-sdk-php
```

<a name="authentication"></a>

## Authentication

Expert stats APIs supports OAuth2 for authentication.
However, this package currently only supports the Password Grant authentication flow.

<a name="authentication-client-code-grant"></a>

### Client Code Grant

Not supported yet.

<a name="authentication-password-grant"></a>

### Password Grant

To connect using your usual Expert stats credentials, first initiate the `ExpertStatisticsConnector` class providing your instance URL, email and password :

```php
use CXEngine\ExpertStats\ExpertStatisticsConnector;

$api = new ExpertStatisticsConnector(
    apiUrl: 'https://xp-stats-201.bluerock.tel/api',
    email: 'developers@bluerocktel.com',
    password: 'secret',
);
```

If the connector fails to retrive a Bearer token from the provided credentials, a `CXEngine\ExpertStats\Exceptions\AuthenticationException` will be thrown.

<a name="usage"></a>

## Usage

To query the API, you can either call each API [Endpoints requests](https://github.com/CX-engine/expert-stats-api-sdk-php/tree/main/src/Requests) individually, or make use of provided [Resources classes](https://github.com/CX-engine/expert-stats-api-sdk-php/tree/main/src/Resources) which groups the requests into clusters.


<a name="usage-requests"></a>

### Using Requests

Using single requests is pretty straightforward. You can use the `call()` method of the `ExpertStatisticsConnector` class to send the desired request to the instance :

```php
use CXEngine\ExpertStats\ExpertStatisticsConnector;
use CXEngine\ExpertStats\Requests;

$api = new ExpertStatisticsConnector(XPSTATS_API_URL, XPSTATS_API_USERNAME, XPSTATS_API_PASSWORD);

$response = $api->call(
  new Requests\Pbx3cxHosts\GetPbx3cxHostsRequest()
);
```

<a name="usage-resources"></a>

### Using Resources

Using resources is a more convenient way to query the API. Each Resource class groups requests by specific API namespaces (Pbx3cxHost, Pbx3cxCall...).

```php
use CXEngine\ExpertStats\ExpertStatisticsConnector;

$api = new ExpertStatisticsConnector(XPSTATS_API_URL, XPSTATS_API_USERNAME, XPSTATS_API_PASSWORD);

$response = $api->pbx3cxCall()->index(
    hostName: 'pbx01.acme.com',
);
```

Resources classes usually provide (but are not limited to) the following methods :

```php
class NamespaceResource
{
    public function index(array $params = [], int $perPage = 20, int $page = 1): Response;
    public function show(int $id): Response;
    public function store(Entity $entity): Response;
    public function update(Entity $entity): Response;
    public function upsert(Entity $entity): Response;
    public function delete(int $id): Response;
}
```

> 👉 The `upsert()` method is a simple alias : it will call the `update()` method if the given entity has an id, or the `store()` method if not.

Each of those namespace resources can be accessed using the `ExpertStatisticsConnector` instance :

```php
$connector = new ExpertStatisticsConnector(...);

$connector->pbx3cxHost(): Resources\Pbx3cxHostResource
$connector->pbx3cxCall(): Resources\Pbx3cxCallResource
...
```

If needed, it is also possible to create the desired resource instance manually.

```php
use CXEngine\ExpertStats\ExpertStatisticsConnector;
use CXEngine\ExpertStats\Resources\Pbx3cxHostResource;

$api = new ExpertStatisticsConnector();
$resource = new Pbx3cxHostResource($api);

$hostData = $resource->show($hostId)->dtoOrFail();
$resource->upsert($hostData);
```

<a name="usage-responses"></a>

### Responses

Weither you are using Requests or Resources, the response is always an instance of `Saloon\Http\Response` class.
It provides some useful methods to check the response status and get the response data.

```php
// Check response status
$response->ok();
$response->failed();
$response->status();
$response->headers();

// Get response data
$response->json(); # as an array
$response->body(); # as an raw string
$response->dtoOrFail(); # as a Data Transfer Object
```

You can learn more about responses by reading the [Saloon documentation](https://docs.saloon.dev/the-basics/responses#useful-methods), which this SDK uses underneath.

<a name="usage-entities"></a>

### Entities (DTO)

When working with APIs, dealing with a raw or JSON response can be tedious and unpredictable.

To make it easier, this SDK provides a way to transform the response data into a Data Transfer Object (DTO) (later called Entities). This way, you are aware of the structure of the data you are working with, and you can access the data using object typed properties instead of untyped array keys.


```php
$response = $api->pbx3cxCall()->show(id: 92);

/** @var CXEngine\ExpertStats\Entities\Pbx3cxCall */
$call = $response->dtoOrFail();
```


Although you can use the `dto()` method to transform the response data into an entity, it is recommended to use the `dtoOrFail()` method instead. This method will throw an exception if the response status is not 2xx, instead of returning an empty DTO.

It is still possible to access the underlying response object using the `getResponse()` method of the DTO :

```php
$entity = $response->dtoOrFail();   // \CXEngine\ExpertStats\Contracts\Entity
$entity->getResponse();             // \Saloon\Http\Response
```

> Learn more about working with Data tranfert objects on the [Saloon documentation](https://docs.saloon.dev/digging-deeper/data-transfer-objects).

The create/update/upsert routes will often ask for a DTO as first parameter :

```php
use CXEngine\ExpertStats\Entities\Pbx3cxHost;

// create
$response = $api->pbx3cxHost()->store(
    host: new Pbx3cxHost(
        host_name: 'pbx01.acme.com',
        customer_account: 'CL0001',
    ),
);

$host = $response->dtoOrFail();

// update
$host->customer_account = 'CX0010';
$api->pbx3cxHost()->update($host);
```


<a name="usage-pagination"></a>

### Pagination

On some index/search routes, the Expert stats API will use a pagination.
If you need to iterate on all pages of the endpoint, you may find handy to use the connector's `paginate()` method :

```php
$query = [
  'sort' => 'created_at',
];

# Create a PagedPaginator instance
$paginator = $api->paginate(new GetExamplesRequest($query));

# Iterate on all pages entities, using lazy loading for performance
foreach ($paginator->items() as $example) {
    $name = $example->name;
}
```

Read more about lazy paginations on the [Saloon documentation](https://docs.saloon.dev/installable-plugins/pagination#using-the-paginator).

<a name="usage-extends"></a>

### Extending the SDK

You may easily extend the SDK by creating your own Resources, Requests, and Entities.

Then, by extending the `ExpertStatisticsConnector` class, add you new resources to the connector :

```php
use CXEngine\ExpertStats\ExpertStatisticsConnector;

class MyCustomConnector extends ExpertStatisticsConnector
{
    public function defaultConfig(): array
    {
        return [
            'timeout' => 120,
        ];
    }

    public function customResource(): \App\Resources\CustomResource
    {
        return new \App\Resources\CustomResource($this);
    }
}

$api = new MyCustomConnector(XPSTATS_API_URL, XPSTATS_API_USERNAME, XPSTATS_API_PASSWORD);
$api->customResource()->index();
```
