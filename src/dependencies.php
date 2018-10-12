<?php

use chillerlan\SimpleCache\Drivers\RedisDriver;
use chillerlan\SimpleCache\Cache;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Bnf\Slim3Psr15\CallableResolver;

// DIC configuration
$container = $app->getContainer();

$container['cache'] = function ($c) {
    $settings = $c->get('settings')['redis'];
    $redis = new \Redis;
    $redis->connect($settings['host'], $settings['port']);
    $cacheDriver = new RedisDriver($redis);
    $cache = new Cache($cacheDriver);
    return $cache;
};

$container['callableResolver'] = function ($container) {
    return new CallableResolver($container);
};
