<?php declare(strict_types=1);

namespace App\middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use ncryptf\middleware\EncryptionKeyInterface;

final class AccessToken implements MiddlewareInterface
{
    use \Middlewares\Utils\Traits\HasResponseFactory;

    /**
     * @var string $token
     */
    protected $token;

    /**
     * Constructor
     * @param string $token
     */
    public function __construct(string $token = "")
    {
        $this->token = $token;
    }

    /**
     * Processes the request
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->token !== "") {
            if ($request->getHeaderLine('x-access-token') != $this->token) {
                return $this->createResponse(403);
            }
        }
        return $handler->handle($request);
    }
}
