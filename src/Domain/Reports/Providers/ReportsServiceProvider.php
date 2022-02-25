<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Providers;

use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchProductReport;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Events\FetchPerformanceReport;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Listeners\FetchProductReportListener;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Listeners\FetchPerformanceReportListener;

class ReportsServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchPerformanceReport::class => [
            FetchPerformanceReportListener::class,
        ],
        FetchProductReport::class => [
            FetchProductReportListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
