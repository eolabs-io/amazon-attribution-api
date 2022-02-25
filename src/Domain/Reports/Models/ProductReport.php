<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Models;

use EolabsIo\AmazonAttributionApi\Database\Factories\ProductReportFactory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAttributionApiModel;

class ProductReport extends AmazonAttributionApiModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'date',
                    'attributedPurchases14d',
                    'attributedDetailPageViewsClicks14d',
                    'adGroupId',
                    'advertiserName',
                    'productName',
                    'productCategory',
                    'productSubcategory',
                    'brandHaloAttributedPurchases14d',
                    'brandHaloUnitsSold14d',
                    'attributedNewToBrandSales14d',
                    'attributedAddToCartClicks14d',
                    'brandHaloNewToBrandPurchases14d',
                    'brandName',
                    'marketplace',
                    'brandHaloAttributedSales14d',
                    'campaignId',
                    'brandHaloNewToBrandUnitsSold14d',
                    'productAsin',
                    'productConversionType',
                    'attributedNewToBrandUnitsSold14d',
                    'brandHaloAttributedAddToCartClicks14d',
                    'attributedNewToBrandPurchases14d',
                    'unitsSold14d',
                    'productGroup',
                    'brandHaloNewToBrandSales14d',
                    'publisher',
                    'brandHaloDetailPageViewsClicks14d',
                    'attributedSales14d',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ProductReportFactory::new();
    }
}
