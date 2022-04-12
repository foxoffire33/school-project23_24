<?php

namespace Framework\HttpHandler;

use Framework\HttpHandler\Exceptions\MethodNotAllowedException;
use Framework\router\enums\HttpMethods;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class HttpRequest implements RequestInterface
{
    use MessageTrait;
    use RequestTrait;

    public array $parameters;

    /**
     * @param string $method HTTP method
     * @param string|UriInterface $uri URI
     * @param array $headers Request headers
     * @param string|resource|StreamInterface|null $body Request body
     * @param string $version Protocol version
     */
    public function __construct(string $method, $uri, array $headers = [], $body = null, string $version = '1.1')
    {
        if (!($uri instanceof UriInterface))
            $uri = new Uri($uri);

        //Conteroleer of er een hidden field _method gepost is met de juste method
        $postedMethod = filter_input(INPUT_POST, '_method');
        if (isset($postedMethod) && in_array(strtolower($postedMethod), ['delete', 'put', 'patch']))
            $method = strtoupper($_POST['_method']);

        $this->method = $method;

        if(!$this->csrfCheck())
            throw new MethodNotAllowedException();

        $this->uri = $uri;
        $this->setHeaders($headers);
        $this->protocol = $version;
        $this->parameters = $_GET;

        if (!$this->hasHeader('Host'))
            $this->updateHostFromUri();

        if ('' !== $body && null !== $body)
            $this->stream = HttpStream::create($body);
    }

    private function csrfCheck(): bool
    {
        if ($this->method == 'GET')
            return true;

        $token = filter_input(INPUT_POST, 'csrf_token');
        return  $token == $_SESSION['csrf_token'] && $token;
    }

}