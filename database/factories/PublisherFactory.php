<?php

namespace EolabsIo\AmazonAttributionApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Models\Publisher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\AmazonAttributionApi\Domain\Publishers\Models\Publisher>
 */
class PublisherFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publisher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $index = $this->faker->unique()->numberBetween(0, 12);
        $publishers = $this->publishers();
        $publisher = $publishers[$index];

        return [
            'name' => $publisher['name'],
            'id' => $publisher['id'],
            'macroEnabled' => $publisher['macroEnabled'],
        ];
    }

    public function publishers(): array
    {
        return [
            [
                "name" => "Google Ads",
                "id" => "1",
                "macroEnabled" => true
            ],
            [
                "name" => "Facebook Ads",
                "id" => "2",
                "macroEnabled" => true
            ],
            [
                "name" => "Microsoft Ads",
                "id" => "3",
                "macroEnabled" => true
            ],
            [
                "name" => "Pinterest Ads",
                "id" => "4",
                "macroEnabled" => true
            ],
            [
                "name" => "Snapchat Ads",
                "id" => "5",
                "macroEnabled" => false
            ],
            [
                "name" => "Twitter Ads",
                "id" => "6",
                "macroEnabled" => false
            ],
            [
                "name" => "LinkedIn Ads",
                "id" => "7",
                "macroEnabled" => false
            ],
            [
                "name" => "Youtube",
                "id" => "8",
                "macroEnabled" => false
            ],
            [
                "name" => "Display - Other",
                "id" => "9",
                "macroEnabled" => false
            ],
            [
                "name" => "Video - Other",
                "id" => "10",
                "macroEnabled" => false
            ],
            [
                "name" => "Blogpost - Other",
                "id" => "11",
                "macroEnabled" => false
            ],
            [
                "name" => "Email - Other",
                "id" => "12",
                "macroEnabled" => false
            ],
            [
                "name" => "TikTok",
                "id" => "13",
                "macroEnabled" => false
            ],
        ];
    }
}
