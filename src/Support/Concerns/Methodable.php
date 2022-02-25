<?php

namespace EolabsIo\AmazonAttributionApi\Support\Concerns;

trait Methodable
{
    private $method = "post";

    public function usePostMethod(): self
    {
        $this->method = 'post';
        return $this;
    }

    public function useGetMethod(): self
    {
        $this->method = 'get';
        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
