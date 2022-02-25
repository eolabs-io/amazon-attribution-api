<?php

namespace EolabsIo\AmazonAttributionApi\Support\Facades;

use EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher;
use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonAttributionApi\Domain\Reports
 */
class AmazonAttributionPublisher extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Publisher::class;
    }
}
