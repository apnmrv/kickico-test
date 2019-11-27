<?php
namespace Kickico\JsonDataClient\Http;

class RequestOptionsBuilder
{
    private $__baseUri = '';
    private $__timeout = 0;
    private $__allowRedirects = false;
    private $__proxyIp = '';

    /**
     * @param string $baseUri
     * @return RequestOptionsBuilder
     */
    public function setBaseUri(string $baseUri): RequestOptionsBuilder
    {
        $this->__baseUri = $baseUri;
        return $this;
    }

    /**
     * @param int $timeout
     * @return RequestOptionsBuilder
     */
    public function setTimeout(int $timeout): RequestOptionsBuilder
    {
        $this->__timeout = $timeout;
        return $this;
    }

    /**
     * @param bool $allowRedirects
     * @return RequestOptionsBuilder
     */
    public function setAllowRedirects(bool $allowRedirects): RequestOptionsBuilder
    {
        $this->__allowRedirects = $allowRedirects;
        return $this;
    }

    /**
     * @param string $proxyIp
     * @return RequestOptionsBuilder
     */
    public function setProxyIp(string $proxyIp): RequestOptionsBuilder
    {
        $this->__proxyIp = $proxyIp;
        return $this;
    }

    /**
     * @param array $options
     */
    public function set(array $options = []): void
    {
        list(
            $this->__baseUri,
            $this->__timeout,
            $this->__allowRedirects,
            $this->__proxyIp
            ) = $options;
    }

    /**
     * @return RequestOptions
     */
    public function get() : RequestOptions
    {
        return new RequestOptions(
            $this->__baseUri,
            $this->__timeout,
            $this->__allowRedirects,
            $this->__proxyIp
        );
    }
}
