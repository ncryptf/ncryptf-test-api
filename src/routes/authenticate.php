<?php

namespace App\routes;

use App\forms\Login;
use App\models\User;
use Slim\Http\Request;
use Slim\Http\Response;
use ncryptf\Token;

/**
 * Returns a ephemeral key (that isn't ephemeral)
 * @http GET /ek
 * @param Request $request
 * @param Response $response
 * @param array $args
 * @return Response
 */
$app->post('/authenticate', function (Request $request, Response $response, array $args) {

    $params = $request->getParams();
    if (isset($params['email']) && isset($params['password'])) {
        $form = new Login($params['email'], $params['password']);
        if ($user = $form->login()) {
            return $response->withJson([
                'access_token' => $user->getToken()->accessToken,
                'refresh_token' => $user->getToken()->refreshToken,
                'ikm' => \base64_encode($user->getToken()->ikm),
                'signing' => \base64_encode($user->getToken()->signature),
                'expires_at' => $user->getToken()->expiresAt
            ])->withStatus(200);
        }
    }

    return $response->withJson([
        'error' => 'The credentials you provided are not valid.'
    ])->withStatus(400);
});
