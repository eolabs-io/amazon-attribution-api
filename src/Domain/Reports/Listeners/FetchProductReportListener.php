<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Listeners;

use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchProductReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Jobs\PerformFetchProductReport;

class FetchProductReportListener
{
    public function handle(FetchProductReport $event)
    {
        $report = $event->report;
        PerformFetchProductReport::dispatch($report)->onQueue('product-report');
    }
}
