<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Reports;

use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesReports;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\ProductReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\ProcessProductReportResponse;

class ProcessProductReportResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesReports;


    protected function setUp(): void
    {
        parent::setUp();

        $productReport = $this->createProductReports();

        $results = $productReport->fetch();

        (new ProcessProductReportResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_product_report_response()
    {
        $report = ProductReport::first();

        $this->assertEquals($report->date, '20220205');
        $this->assertEquals($report->attributedDetailPageViewsClicks14d, '1');
        $this->assertEquals($report->campaignId, 'Google Adword 1');
        $this->assertEquals($report->adGroupId, 'google ');
        $this->assertEquals($report->attributedPurchases14d, '0');
    }
}
