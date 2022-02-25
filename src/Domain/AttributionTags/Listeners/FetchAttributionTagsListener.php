<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Listeners;

use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Events\FetchAttributionTags;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Jobs\PerformFetchAttributionTags;

class FetchAttributionTagsListener
{
    public function handle(FetchAttributionTags $event)
    {
        $attributionTag = $event->attributionTag;
        PerformFetchAttributionTags::dispatch($attributionTag)->onQueue('attribution-tags');
    }
}
