<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Publishers\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher;

class FetchPublisher
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher */
    public $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }
}
