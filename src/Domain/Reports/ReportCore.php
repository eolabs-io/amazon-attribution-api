<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports;

use EolabsIo\AmazonAttributionApi\Domain\Shared\AmazonAttributionCore;

abstract class ReportCore extends AmazonAttributionCore
{
    public function getBaseUrl(): string
    {
        return 'https://advertising-api.amazon.com';
    }

    public function getEndpoint(): string
    {
        return "/attribution/report";
    }
}
