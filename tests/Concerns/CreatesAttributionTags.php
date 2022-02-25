<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Concerns;

use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionTag;
use EolabsIo\AmazonAttributionApi\Tests\Factories\AmazonAttributionTagFactory;

trait CreatesAttributionTags
{
    public function createAttributionMacroTags()
    {
        AmazonAttributionTagFactory::new()->fakeMacroTagResponse();

        return AmazonAttributionTag::withMacroTag()->withPublisherIds([1,2,3,4]);
    }

    public function createAttributionNonMacroTags()
    {
        AmazonAttributionTagFactory::new()->fakeNonMacroTagResponse();

        return AmazonAttributionTag::withNonMacroTag()->withPublisherIds([6,7,8]);
    }
}
