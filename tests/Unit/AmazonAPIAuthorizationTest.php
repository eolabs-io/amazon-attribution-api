<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Unit;

use EolabsIo\AmazonAttributionApi\Tests\Unit\BaseModelTest;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;

class AmazonAPIAuthorizationTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return AmazonAPIAuthorization::class;
    }
}
