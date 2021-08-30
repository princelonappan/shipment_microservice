## Preface

API gateway is an important component of microservices architectural pattern – it's a layer that sits in front of all your services. [Read more](http://microservices.io/patterns/apigateway.html)

## Overview

The Shipment API is a simple API gateway implemented in PHP7 with Lumen framework

## Requirements and dependencies

- PHP >= 7.2
- Lumen 7.0

## Running as a Docker container

Ideally, you want to run this as a stateless Docker container configured entirely by environment variables. Therefore, you don't even need to deploy 
this code anywhere yourself - just use our [public Docker Hub image](https://hub.docker.com/r/pwred/vrata).

Deploying it is as easy as:

```bash
$ docker run -d -e GATEWAY_SERVICES=... -e GATEWAY_GLOBAL=... -e GATEWAY_ROUTES=... pwred/vrata
```

Where environment variables are JSON encoded settings (see configuration options below).

## Features

- Shipment API Service for calculating the estimate delivery time.

## Installation

First, clone the repo:
```bash
$ git clone git@github.com:hasib32/rest-api-with-lumen.git
```
#### Install dependencies
```
$ cd rest-api-with-lumen
$ composer install
```
### API Routes
| HTTP Method	| Path | Action | Parameter | Desciption  |
| ----- | ----- | ----- | ---- |------------- |
| GET      | /api/get_lunar_shipment_time | getDeliveryTime | earth_time=2021-08-27 17:22:40 | Lunar Shipment Time

### Output 

You can do basic JSON output mutation using ```output``` property of an action. Eg.
```php
{
    "success": 1,
    "message": "Success",
    "delivery_time": "54-9-18 ∇  4:6:17"
}
```
#### Run Swagger

You can access the Swagger API through the following end point. <br />
```/api/documentation```

```
$ cd rest-api-with-lumen
$ php artisan swagger-lume:generate
$ php artisan swagger-lume:publish
$ cp -a vendor/swagger-api/swagger-ui/dist public/swagger-ui-assets
```
#### Run the Unit Test

```
$ ./vendor/bin/phpunit
```
