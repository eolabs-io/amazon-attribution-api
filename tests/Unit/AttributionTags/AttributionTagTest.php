<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Unit\AttributionTags;

use EolabsIo\AmazonAttributionApi\Tests\Unit\BaseModelTest;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Models\AttributionTag;

class AttributionTagTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return AttributionTag::class;
    }
}
