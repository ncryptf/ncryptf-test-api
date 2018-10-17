<?php

namespace App\routes;

use App\middleware\Authentication;
use App\models\EncryptionKey;
use Slim\Http\Response;
use Zend\Diactoros\Stream;

/**
 * Unauthenticated request to echo whatever the client sends
 * @http POST /echo
 * @param Request $request
 * @param Response $response
 * @param array $args
 * @return Response
 */
$app->post('/echo', function ($request, Response $response, array $args) {
    if ($contentType = $request->getHeaderLine('Content-Type', false)) {
        if ($contentType === 'application/vnd.ncryptf+json') {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $request->getAttribute('ncryptf-decrypted-body'));
            rewind($stream);
            return $response->withBody(new Stream($stream));
        }
    }
    return $response->withBody($request->getBody());
});

/**
 * Authenticate echo
 * @http PUT /echo
 * @param Request $request
 * @param Response $response
 * @param array $args
 * @return Response
 */
$app->put('/echo', function ($request, Response $response, array $args) {
    if ($contentType = $request->getHeaderLine('Content-Type', false)) {
        if ($contentType === 'application/vnd.ncryptf+json') {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $request->getAttribute('ncryptf-decrypted-body'));
            rewind($stream);
            return $response->withBody(new Stream($stream));
        }
    }
    return $response->withBody($request->getBody());
});
