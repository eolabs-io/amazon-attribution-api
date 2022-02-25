<?php

namespace EolabsIo\AmazonAttributionApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAPIAuthorization>
 */
class AmazonAPIAuthorizationFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AmazonAPIAuthorization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => "amzn1.application-oa2-client.{$this->faker->sha1}",
            'scope' => $this->faker->randomNumber(9, true),
            'refresh_token' => "Atzr|{$this->faker->sha256}",
        ];
    }
}
