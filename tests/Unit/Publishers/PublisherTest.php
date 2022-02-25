<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Unit\Publishers;

use EolabsIo\AmazonAttributionApi\Tests\Unit\BaseModelTest;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Models\Publisher;

class PublisherTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Publisher::class;
    }
}
