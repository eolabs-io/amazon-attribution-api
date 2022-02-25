<?php

namespace EolabsIo\AmazonAttributionApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\ProductReport;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\AmazonAttributionApi\Domain\Shared\Models\PerformanceReport>
 */
class ProductReportFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date('Ymd'),
            'attributedPurchases14d' => $this->faker->randomDigit(),
            'attributedDetailPageViewsClicks14d' => $this->faker->randomDigit(),
            'adGroupId' => $this->faker->randomDigit(6),
            'advertiserName' => $this->faker->company(),
            'productName' => $this->faker->text(),
            'productCategory' => "5000 Nutrition & Wellness",
            'productSubcategory' => "5030 Diet Supplements",
            'brandHaloAttributedPurchases14d' => $this->faker->randomDigit(),
            'brandHaloUnitsSold14d' => $this->faker->randomDigit(),
            'attributedNewToBrandSales14d' => $this->faker->randomDigit(),
            'attributedAddToCartClicks14d' => $this->faker->randomDigit(),
            'brandHaloNewToBrandPurchases14d' => $this->faker->randomDigit(),
            'brandName' => $this->faker->text(),
            'marketplace' => "AMAZON.COM",
            'brandHaloAttributedSales14d' => $this->faker->randomDigit(),
            'campaignId' => $this->faker->randomNumber(5),
            'brandHaloNewToBrandUnitsSold14d' => $this->faker->randomDigit(),
            'productAsin' => $this->faker->text(10),
            'productConversionType' => "Promoted",
            'attributedNewToBrandUnitsSold14d' => $this->faker->randomDigit(),
            'brandHaloAttributedAddToCartClicks14d' => $this->faker->randomDigit(),
            'attributedNewToBrandPurchases14d' => $this->faker->randomDigit(),
            'unitsSold14d' => $this->faker->randomDigit(),
            'productGroup' => "Drugstore",
            'brandHaloNewToBrandSales14d' => $this->faker->randomDigit(),
            'publisher' => $this->faker->randomElement(['Google Adwords']),
            'brandHaloDetailPageViewsClicks14d' => $this->faker->randomDigit(),
            'attributedSales14d' => $this->faker->randomFloat(2),
        ];
    }
}
