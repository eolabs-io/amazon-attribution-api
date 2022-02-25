<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchPerformanceReport;

class PerformanceReportCommand extends Command
{
    protected $signature = 'amazon-attribution-api:performance-report
                            {--advertiser-ids=* : One or more advertiser Ids to filter reporting by. If requesting reporting for multiple advertiser Ids.}
                            {--end-date= : The end date for the report.}
                            {--count= : The number of entries to include in the report.}
                            {--metrics=* : list of metrics to include in the report. Each report type returns a unique set of metrics.}
                            {--start-date= : The start date for the report.}';


    protected $description = 'Gets Performance Report from Amazon Attribution API';


    public function handle()
    {
        $this->info('Geting Performance Report from Amazon Attribution API...');


        $advertiserIds = $this->option('advertiser-ids');
        $endDate = $this->option('end-date');
        $count = $this->option('count');
        $metrics = $this->option('metrics');
        $startDate = $this->option('start-date');

        $performanceReport = AmazonAttributionReport::withReportTypePerformance();

        if ($advertiserIds) {
            $performanceReport->withAdvertiserIds($advertiserIds);
        }

        if ($endDate) {
            $performanceReport->withEndDate(Carbon::create($endDate));
        }

        if ($count) {
            $performanceReport->withCount($count);
        }

        if ($metrics) {
            $performanceReport->withMetrics($metrics);
        }

        if ($startDate) {
            $performanceReport->withStartDate(Carbon::create($startDate));
        }

        FetchPerformanceReport::dispatch($performanceReport);
    }
}
