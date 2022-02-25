<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Providers;

use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Events\FetchAttributionTags;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Listeners\FetchAttributionTagsListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AttributionTagsServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchAttributionTags::class => [
            FetchAttributionTagsListener::class,
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
