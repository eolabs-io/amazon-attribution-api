<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Concerns;

use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionReport;
use EolabsIo\AmazonAttributionApi\Tests\Factories\AmazonAttributionReportFactory;

trait CreatesReports
{
    public function createPerformanceReports()
    {
        AmazonAttributionReportFactory::new()->fakePerformanceReportResponse();

        return AmazonAttributionReport::withReportTypePerformance();
    }

    public function createPerformanceReportsWithCursorId()
    {
        AmazonAttributionReportFactory::new()->fakePerformanceReportResponseWithCursorId();

        return AmazonAttributionReport::withReportTypePerformance();
    }

    public function createProductReports()
    {
        AmazonAttributionReportFactory::new()->fakeProductReportResponse();

        return AmazonAttributionReport::withReportTypePerformance();
    }

    public function createProductReportsWithCursorId()
    {
        AmazonAttributionReportFactory::new()->fakeProductReportResponseWithCursorId();

        return AmazonAttributionReport::withReportTypePerformance();
    }
}
