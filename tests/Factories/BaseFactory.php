<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Factories;

use EolabsIo\AmazonAttributionApi\Tests\Factories\Contracts\FactoryInterface;

abstract class BaseFactory implements FactoryInterface
{
    public static function new(): self
    {
        return new static();
    }
}
