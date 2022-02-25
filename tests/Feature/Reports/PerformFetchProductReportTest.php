<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Reports;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesReports;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchProductReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\PerformFetchProductReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\ProcessProductReportResponse;

class PerformFetchProductReportTest extends TestCase
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
        $productReport = $this->createProductReports();

        PerformFetchProductReport::dispatch($productReport);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchProductReport::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessProductReportResponse::class, function ($job) {
            return data_get($job->results, 'reports.0.campaignId') === 'Google Adword 1';
        });

        // Assert that was not called for CursorId
        Event::assertNotDispatched(FetchProductReport::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_token()
    {
        $productReport = $this->createProductReportsWithCursorId();

        PerformFetchProductReport::dispatch($productReport);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchProductReport::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessProductReportResponse::class, function ($job) {
            return data_get($job->results, 'reports.0.campaignId') === 'Google Adword 2';
        });

        // Assert that was not called for CursorId
        Event::assertDispatched(FetchProductReport::class);
    }
}
