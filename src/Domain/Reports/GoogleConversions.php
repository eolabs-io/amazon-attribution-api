<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\PerformanceReport;

class GoogleConversions
{
    /** @var Carbon */
    public $startDate;

    /** @var Carbon */
    public $endDate;


    public function __construct()
    {
        $this->startDate = Carbon::now()->subDays(14);
        $this->endDate = Carbon::now();
    }

    public function withStartDate(Carbon $date): self
    {
        $this->startDate = $date;

        return $this;
    }

    public function withEndDate(Carbon $date): self
    {
        $this->endDate = $date;

        return $this;
    }

    public function get(): Collection
    {
        return collect([
            $this->productSales()->get(),
            $this->addToCart()->get(),
            $this->detailPageView()->get(),
        ])->flatten(1);
    }

    public function productSales()
    {
        return $this->applyFilters(
            PerformanceReport::where('attributedPurchases14d', '>', 0)
                ->selectRaw("creativeId AS 'Google Click Id'")
                ->selectRaw("'ProductSales' AS 'Conversion Name'")
                ->selectRaw("DATE_FORMAT(DATE_ADD(date, INTERVAL 1 DAY ),'%Y-%m-%d %H:%i:%s') AS 'Conversion Time'")
                ->selectRaw("attributedSales14d AS 'Conversion Value'")
                ->selectRaw("'USD' AS 'Conversion Currency'")
        );
    }

    public function addToCart()
    {
        return $this->applyFilters(
            PerformanceReport::where('attributedAddToCartClicks14d', '>', 0)
                ->selectRaw("creativeId AS 'Google Click Id'")
                ->selectRaw("'AddToCart' AS 'Conversion Name'")
                ->selectRaw("DATE_FORMAT(DATE_ADD(date, INTERVAL 1 DAY ),'%Y-%m-%d %H:%i:%s') AS 'Conversion Time'")
                ->selectRaw("'0' AS 'Conversion Value'")
                ->selectRaw("'USD' AS 'Conversion Currency'")
        );
    }

    public function detailPageView()
    {
        return $this->applyFilters(
            PerformanceReport::where('attributedDetailPageViewsClicks14d', '>', 0)
                ->selectRaw("creativeId AS 'Google Click Id'")
                ->selectRaw("'DetailPageView' AS 'Conversion Name'")
                ->selectRaw("DATE_FORMAT(DATE_ADD(date, INTERVAL 1 DAY ),'%Y-%m-%d %H:%i:%s') AS 'Conversion Time'")
                ->selectRaw("'0' AS 'Conversion Value'")
                ->selectRaw("'USD' AS 'Conversion Currency'")
        );
    }

    public function applyFilters($query)
    {
        return $query
                    ->whereIn('publisher', $this->publishers())
                    ->where('creativeId', 'NOT LIKE', "Creative for%")
                    ->where('creativeId', 'NOT LIKE', '{gclid}')
                    ->where('date', '>=', $this->startDate)
                    ->where('date', '<=', $this->endDate);
    }

    public function toCSV()
    {
        $results = $this->get();

        if ($results->count() < 1) {
            return;
        }

        $titles = implode(',', array_keys((array) $results->first()->getAttributes()));

        $values = $results->map(function ($result) {
            return implode(',', collect($result->getAttributes())->map(function ($thing) {
                return '"'.$thing.'"';
            })->toArray());
        });

        $values->prepend($titles);
        $values->prepend("Parameters:TimeZone={$this->getTimeZone()}");

        return $values->implode("\n");
    }


    public function getTimeZone(): string
    {
        return "-0800";
    }

    public function publishers(): array
    {
        return [
            'Google Adwords',
            'Google Ads',
        ];
    }
}
