<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Reports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionReport;
use EolabsIo\AmazonAttributionApi\Tests\Factories\AmazonAttributionReportFactory;

class AmazonAttributionReportTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        AmazonAttributionReportFactory::new()->fakePerformanceReportResponse();

        $advertiserIds = ['2291326454'];
        $endDate = Carbon::create(2020, 3, 24, 12);
        $count = 20;
        $metrics = ['Click-throughs', 'attributedDetailPageViewsClicks14d'];
        $startDate = Carbon::create(2020, 2, 24, 12);

        AmazonAttributionReport::withReportTypePerformance()
            ->withAdvertiserIds($advertiserIds)
            ->withEndDate($endDate)
            ->withCount($count)
            ->withMetrics($metrics)
            ->withStartDate($startDate)
            ->fetch();

        Http::assertSent(function ($request) {
            return $request->url() == "https://advertising-api.amazon.com/attribution/report" &&
                   $request->method() == "POST" &&

            // Headers
                    $request->hasHeader('Amazon-Advertising-API-ClientId', 'amzn1.application-oa2-client.a925EXAMPLE0b302baf3e644a') &&
                    $request->hasHeader('Authorization', 'Bearer Atza|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
                    $request->hasHeader('Amazon-Advertising-API-Scope', 1234567890) &&
            // Body
                    $request['reportType'] == 'PERFORMANCE' &&
                    $request['advertiserIds'] == '2291326454' &&
                    $request['endDate'] == '20200324' &&
                    $request['count'] == 20 &&
                    $request['metrics'] == 'Click-throughs,attributedDetailPageViewsClicks14d' &&
                    $request['startDate'] == '20200224';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        AmazonAttributionReportFactory::new()->fakePerformanceReportResponse();

        $response = AmazonAttributionReport::withReportTypePerformance()->fetch();

        $reports = $response['reports'];

        $this->assertCount(10, $response['reports']);

        $report = $reports[0];

        $this->assertEquals('20220205', $report['date']);
        $this->assertEquals('3', $report['attributedAddToCartClicks14d']);
        $this->assertEquals('Google Adwords 3', $report['campaignId']);
        $this->assertEquals('0', $report['attributedPurchases14d']);
    }

    /** @test */
    public function it_gets_the_correct_response_with_cursor_id()
    {
        AmazonAttributionReportFactory::new()->fakePerformanceReportResponseWithCursorId();

        $amazonAttributionReport = AmazonAttributionReport::withReportTypePerformance();
        $cursorIdResponse = $amazonAttributionReport->fetch();


        $this->assertTrue($amazonAttributionReport->hasCursorId());

        $response = $amazonAttributionReport->fetch();


        $campaignId1 = data_get($response, 'reports.0.campaignId');
        $campaignId2 = data_get($cursorIdResponse, 'reports.0.campaignId');

        $this->assertEquals('Google Adwords 3', $campaignId1);
        $this->assertEquals('Google Adwords 333', $campaignId2);

        $this->assertCount(3, $cursorIdResponse['reports']);
        $this->assertCount(10, $response['reports']);

        $this->assertSentReportWithCursorId();
    }

    public function assertSentReportWithCursorId()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[3][0];

        $this->assertTrue(
            $request->url() == "https://advertising-api.amazon.com/attribution/report" &&
           $request['cursorId'] == "{\"values\":[17103463201,1644192000000],\"page\":1,\"fields\":[\"creative_id\",\"day_timestamp\"],\"version\":\"V2\"}" &&
           $request['reportType'] == 'PERFORMANCE'
        );
    }
}
