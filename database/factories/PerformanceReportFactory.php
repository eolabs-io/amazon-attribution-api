<?php

namespace EolabsIo\AmazonAttributionApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\PerformanceReport;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\AmazonAttributionApi\Domain\Shared\Models\PerformanceReport>
 */
class PerformanceReportFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PerformanceReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date('Ymd'),
            'attributedAddToCartClicks14d' => $this->faker->randomDigit(),
            'campaignId' => $this->faker->randomNumber(5),
            'attributedPurchases14d' => $this->faker->randomDigit(),
            'attributedDetailPageViewsClicks14d' => $this->faker->randomDigit(),
            'attributedTotalAddToCartClicks14d' => $this->faker->randomDigit(),
            'attributedTotalPurchases14d' => $this->faker->randomDigit(),
            'adGroupId' => $this->faker->randomDigit(6),
            'advertiserName' => $this->faker->company(),
            'creativeId' => $this->faker->randomDigit(6),
            'totalUnitsSold14d' => $this->faker->randomDigit(),
            'unitsSold14d' => $this->faker->randomDigit(),
            'Click-throughs' => $this->faker->randomDigit(),
            'publisher' => $this->faker->randomElement(['Google Adwords']),
            'attributedTotalDetailPageViewsClicks14d' => $this->faker->randomDigit(),
            'attributedSales14d' => $this->faker->randomFloat(2),
            'totalAttributedSales14d' => $this->faker->randomFloat(2),
        ];
    }
}
