<?php
namespace EolabsIo\AmazonAttributionApi\Tests\Unit\Reports;

use EolabsIo\AmazonAttributionApi\Tests\Unit\BaseModelTest;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\PerformanceReport;

class PerformanceReportTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PerformanceReport::class;
    }
}
