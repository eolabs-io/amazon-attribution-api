<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTag;

class FetchAttributionTags
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTag */
    public $attributionTag;

    public function __construct(AttributionTag $attributionTag)
    {
        $this->attributionTag = $attributionTag;
    }
}
