<?php
namespace EolabsIo\AmazonAttributionApi\Tests\Unit\Reports;

use EolabsIo\AmazonAttributionApi\Tests\Unit\BaseModelTest;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\ProductReport;

class ProductReportTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductReport::class;
    }
}
