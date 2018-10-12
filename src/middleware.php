<?php

use App\middleware\Authentication;
use App\models\EncryptionKey;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ncryptf\middleware\JsonRequestParser;
use ncryptf\middleware\JsonResponseFormatter;

$container = $app->getContainer();

// This is processed in reverse order
$app->add(new JsonResponseFormatter($container['cache'], EncryptionKey::class));
$app->add(new class implements MiddlewareInterface {
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getUri()->getPath() == '/echo' && \strtoupper($request->getMethod()) == 'PUT') {
            $middleware = new Authentication;
            return $middleware->process($request, $handler);
        }
        return $handler->handle($request);
    }
});
$app->add(new JsonRequestParser($container['cache']));
