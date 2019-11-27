<?php
namespace Kickico\JsonDataClient\Http;

class RequestOptions
{
   private $__baseUri;
   private $__timeout;
   private $__allowRedirects;
   private $__proxyIp;

    /**
     * RequestOptions constructor.
     * @param string $baseUri
     * @param int $timeout
     * @param bool $allowRedirects
     * @param string $proxyIp
     */
    public function __construct(string $baseUri, int $timeout = 0, bool $allowRedirects = false, string $proxyIp = '')
    {
        $this->__baseUri = $baseUri;
        $this->__timeout = $timeout;
        $this->__allowRedirects = $allowRedirects;
        $this->__proxyIp = $proxyIp;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->__baseUri;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->__timeout;
    }

    /**
     * @return bool
     */
    public function isAllowRedirects(): bool
    {
        return $this->__allowRedirects;
    }

    /**
     * @return string
     */
    public function getProxyIp(): string
    {
        return $this->__proxyIp;
    }
}
