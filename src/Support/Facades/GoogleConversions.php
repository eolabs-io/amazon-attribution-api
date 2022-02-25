<?php

namespace EolabsIo\AmazonAttributionApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\AmazonAttributionApi\Domain\Reports\GoogleConversions as ReportsGoogleConversions;

/**
 * @see EolabsIo\AmazonAttributionApi\Domain\Reports\GoogleConversions
 */
class GoogleConversions extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ReportsGoogleConversions::class;
    }
}
