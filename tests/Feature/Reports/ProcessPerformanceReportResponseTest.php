<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Reports;

use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\ProcessPerformanceReportResponse;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\PerformanceReport;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesReports;

class ProcessPerformanceReportResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesReports;


    protected function setUp(): void
    {
        parent::setUp();

        $performanceReport = $this->createPerformanceReports();

        $results = $performanceReport->fetch();

        (new ProcessPerformanceReportResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_performance_report_response()
    {
        $report = PerformanceReport::first();

        $this->assertEquals($report->date, '20220205');
        $this->assertEquals($report->attributedAddToCartClicks14d, '3');

        $this->assertEquals($report->campaignId, 'Google Adwords 3');
        $this->assertEquals($report->adGroupId, 'Mood Boost');
        $this->assertEquals($report->creativeId, 'Creative for Mood Boost');
        $this->assertEquals($report->attributedPurchases14d, '0');
    }
}
