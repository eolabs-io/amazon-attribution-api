<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Report;

class FetchPerformanceReport
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonAttributionApi\Domain\Reports\Report */
    public $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }
}
