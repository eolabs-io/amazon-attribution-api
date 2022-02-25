<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Publishers\Providers;

use EolabsIo\AmazonAttributionApi\Domain\Publishers\Events\FetchPublisher;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Listeners\FetchPublisherListener;

class PublishersServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchPublisher::class => [
            FetchPublisherListener::class,
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
