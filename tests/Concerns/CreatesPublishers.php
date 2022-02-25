<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Concerns;

use EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher;
use EolabsIo\AmazonAttributionApi\Tests\Factories\AmazonAttributionPublisherFactory;

trait CreatesPublishers
{
    public function createPublishers()
    {
        AmazonAttributionPublisherFactory::new()->fakePublisherResponse();

        return new Publisher;
    }
}
