<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchProductReport;

class ProductReportCommand extends Command
{
    protected $signature = 'amazon-attribution-api:product-report
                            {--advertiser-ids=* : One or more advertiser Ids to filter reporting by. If requesting reporting for multiple advertiser Ids.}
                            {--end-date= : The end date for the report.}
                            {--count : The number of entries to include in the report.}
                            {--metrics=* : list of metrics to include in the report. Each report type returns a unique set of metrics.}
                            {--start-date= : The start date for the report.}';


    protected $description = 'Gets Product Report from Amazon Attribution API';


    public function handle()
    {
        $this->info('Geting Product Report from Amazon Attribution API...');


        $advertiserIds = $this->option('advertiser-ids');
        $endDate = $this->option('end-date');
        $count = $this->option('count');
        $metrics = $this->option('metrics');
        $startDate = $this->option('start-date');

        $productReport = AmazonAttributionReport::withReportTypeProducts();

        if ($advertiserIds) {
            $productReport->withAdvertiserIds($advertiserIds);
        }

        if ($endDate) {
            $productReport->withEndDate(Carbon::create($endDate));
        }

        if ($count) {
            $productReport->withCount($count);
        }

        if ($metrics) {
            $productReport->withMetrics($metrics);
        }

        if ($startDate) {
            $productReport->withStartDate(Carbon::create($startDate));
        }

        FetchProductReport::dispatch($productReport);
    }
}
