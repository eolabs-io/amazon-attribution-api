<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Publishers\Listeners;

use EolabsIo\AmazonAttributionApi\Domain\Publishers\Events\FetchPublisher;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Jobs\PerformFetchPublisher;

class FetchPublisherListener
{
    public function handle(FetchPublisher $event)
    {
        $publisher = $event->publisher;
        PerformFetchPublisher::dispatch($publisher)->onQueue('publisher');
    }
}
