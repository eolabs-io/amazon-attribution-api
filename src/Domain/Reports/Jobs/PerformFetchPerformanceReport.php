<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Report;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchPerformanceReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\ProcessPerformanceReportResponse;

class PerformFetchPerformanceReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonAttributionApi\Domain\Reports\Report */
    public $report;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->report->fetch();

        ProcessPerformanceReportResponse::dispatch($results);
        FetchPerformanceReport::dispatchIf($this->report->hasCursorId(), $this->report);
    }
}
