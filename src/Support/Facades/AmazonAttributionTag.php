<?php

namespace EolabsIo\AmazonAttributionApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTag;

/**
 * @see EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTag
 */
class AmazonAttributionTag extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AttributionTag::class;
    }
}
