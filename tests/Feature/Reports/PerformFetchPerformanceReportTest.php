<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Reports;

use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchPerformanceReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\PerformFetchPerformanceReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\ProcessPerformanceReportResponse;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesReports;

class PerformFetchPerformanceReportTest extends TestCase
{
    use CreatesReports;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job_without_token()
    {
        $performanceReport = $this->createPerformanceReports();

        PerformFetchPerformanceReport::dispatch($performanceReport);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchPerformanceReport::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessPerformanceReportResponse::class, function ($job) {
            return data_get($job->results, 'reports.0.campaignId') === 'Google Adwords 3';
        });

        // Assert that was not called for CursorId
        Event::assertNotDispatched(FetchPerformanceReport::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_token()
    {
        $performanceReport = $this->createPerformanceReportsWithCursorId();

        PerformFetchPerformanceReport::dispatch($performanceReport);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchPerformanceReport::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessPerformanceReportResponse::class, function ($job) {
            return data_get($job->results, 'reports.0.campaignId') === 'Google Adwords 333';
        });

        // Assert that was not called for CursorId
        Event::assertDispatched(FetchPerformanceReport::class);
    }
}
