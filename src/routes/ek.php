<?php

namespace App\routes;

use Zend\Diactoros\ServerRequest as Request;
use Slim\Http\Response;
use App\models\EncryptionKey;

/**
 * Returns a ephemeral key (that isn't ephemeral)
 * @http GET /ek
 * @param Request $request
 * @param Response $response
 * @param array $args
 * @return Response
 */
$app->get('/ek', function (Request $request, Response $response, array $args) {
    $key = EncryptionKey::generate();

    $this->cache->set($key->getHashIdentifier(), \function_exists('igbinary_serialize') ? \igbinary_serialize($key) : \serialize($key), 900);

    return $response->withJson([
        'public' => \base64_encode($key->getBoxPublicKey()),
        'signature' => \base64_encode($key->getSignPublicKey()),
        'hash-id' => $key->getHashIdentifier()
    ]);
});
