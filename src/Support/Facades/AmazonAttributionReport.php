<?php

namespace EolabsIo\AmazonAttributionApi\Support\Facades;

use EolabsIo\AmazonAttributionApi\Domain\Reports\Report;
use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonAttributionApi\Domain\Reports
 */
class AmazonAttributionReport extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Report::class;
    }
}
