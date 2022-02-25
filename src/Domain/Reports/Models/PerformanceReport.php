<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Models;

use EolabsIo\AmazonAttributionApi\Database\Factories\PerformanceReportFactory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAttributionApiModel;

class PerformanceReport extends AmazonAttributionApiModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'date',
                    'attributedAddToCartClicks14d',
                    'campaignId',
                    'attributedPurchases14d',
                    'attributedDetailPageViewsClicks14d',
                    'attributedTotalAddToCartClicks14d',
                    'attributedTotalPurchases14d',
                    'adGroupId',
                    'advertiserName',
                    'creativeId',
                    'totalUnitsSold14d',
                    'unitsSold14d',
                    'Click-throughs',
                    'publisher',
                    'attributedTotalDetailPageViewsClicks14d',
                    'attributedSales14d',
                    'totalAttributedSales14d',
                ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PerformanceReportFactory::new();
    }
}
