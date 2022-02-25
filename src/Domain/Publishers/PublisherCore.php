<?php
namespace EolabsIo\AmazonAttributionApi\Domain\Publishers;

use EolabsIo\AmazonAttributionApi\Domain\Shared\AmazonAttributionCore;

abstract class PublisherCore extends AmazonAttributionCore
{
    public function getBaseUrl(): string
    {
        return 'https://advertising-api.amazon.com';
    }

    public function getEndpoint(): string
    {
        return "/attribution/publishers";
    }
}
