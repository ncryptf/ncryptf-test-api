# Ncryptf Test API

A Slim framework, ReactPHP, ncryptf capable API written in PHP 7.2

This repository provides a very simple ncryptf API for integration testing, and to serve as a basic implementation example using a PSR-15 compatible frameworks.

It's primary purpose is to serve as a public API for ncryptf libraries to test end-to-end implementations against.

For implementation examples, refer to the `IntgrationTest` test class in the ncryptf library language.

| Language |
|----------|
| [Java](https://github.com/ncryptf/ncryptf-java/blob/master/src/test/java/com/ncryptf/Test/IntegrationTest.java) |
| Kotlin |
| [.Net Core](https://github.com/ncryptf/ncryptf-core/blob/master/ncryptf.Test/IntegrationTest.cs) |
| [PHP](https://github.com/ncryptf/ncryptf-php/blob/master/tests/IntegrationTest.php) |
| Swift |

> This library is provided as reference material, and is not guaranteed to be updated. Please review direct implementation examples, or other documentation.

## Using this software

This API can be implemented using `docker` simply by running `docker-compose up --compress -d`. This API will be made available on http://127.0.0.1:8080.

## Development

Currently development is done using the built in PHP web server.

```bash
export REDIS_HOST=<IP_OF_REDIS>
export ENV=dev
composer install -ovna
php -S [::]:8080 -t ./web
```

## Environment variables

| Variable   | Description |
|------------|-------------|
| REDIS_HOST | The IP address of a Redis 4.0 instance |
| ENV | Set to `dev` to run the built in PHP web server instead of the ReactPHP server. |
| ACCESS_TOKEN | An optional alphanumeric string to help prevent unauthorized API access. |
