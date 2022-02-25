<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags;

use EolabsIo\AmazonAttributionApi\Domain\Shared\AmazonAttributionCore;

abstract class AttributionTagCore extends AmazonAttributionCore
{
    public function getBaseUrl(): string
    {
        return 'https://advertising-api.amazon.com';
    }

    public function getEndpoint(): string
    {
        return "/attribution/tags";
    }
}
