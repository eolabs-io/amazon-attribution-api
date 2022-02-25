<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Concerns;

use Illuminate\Support\Carbon;

trait InteractsWithReports
{
    /** @var array */
    private $reportParameters = [];


    public function withReportTypePerformance(): self
    {
        $this->reportParameters['reportType'] = 'PERFORMANCE';

        return $this;
    }

    public function withReportTypeProducts(): self
    {
        $this->reportParameters['reportType'] = 'PRODUCTS';

        return $this;
    }

    public function withAdvertiserIds(array $advertiserIds): self
    {
        $this->reportParameters['advertiserIds'] = implode(',', $advertiserIds);

        return $this;
    }

    public function withEndDate(Carbon $date): self
    {
        // YYYYMMDD
        $this->reportParameters['endDate'] = $date->format('Ymd');

        return $this;
    }

    public function withCount(int $count): self
    {
        if ($count < 1) {
            $count = 1;
        }

        if ($count > 10000) {
            $count = 10000;
        }

        $this->reportParameters['count'] = $count;

        return $this;
    }


    public function withMetrics(array $metrics): self
    {
        $this->reportParameters['metrics'] = implode(',', $metrics);

        return $this;
    }

    public function withStartDate(Carbon $date): self
    {
        // YYYYMMDD
        $this->reportParameters['startDate'] = $date->format('Ymd');

        return $this;
    }

    public function getReportParameters(): array
    {
        return $this->reportParameters;
    }
}
