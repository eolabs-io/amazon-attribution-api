<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Reports;

use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchPerformanceReport;
use Illuminate\Support\Facades\Event;

class PerformanceReportCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_performance_report_artisan_command()
    {
        $this->artisan('amazon-attribution-api:performance-report
                --start-date=2022-02-1
                --end-date=2022-02-14
                ')
             ->assertExitCode(0);

        // Assert that job was called
        Event::assertDispatched(FetchPerformanceReport::class);
    }
}
