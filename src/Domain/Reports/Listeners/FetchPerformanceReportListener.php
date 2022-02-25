<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Listeners;

use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchPerformanceReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\PerformFetchPerformanceReport;

class FetchPerformanceReportListener
{
    public function handle(FetchPerformanceReport $event)
    {
        $report = $event->report;
        PerformFetchPerformanceReport::dispatch($report)->onQueue('performance-report');
    }
}
