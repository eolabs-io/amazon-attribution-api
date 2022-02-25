<?php

namespace EolabsIo\AmazonAttributionApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Models\AttributionTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\AmazonAttributionApi\Domain\Publishers\Models\Publisher>
 */
class AttributionTagFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttributionTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(0, 12),
            'tag' => $this->faker->randomElement([
                "?maas=maas_adg_api_1964981050701_static_5_73&ref_=aa_maas&tag=maas&aa_campaignid={insertCampaign}&aa_adgroupid={insertAdGroupId}&aa_creativeid={insertCreativeId}",
                "?maas=maas_adg_api_1964981050701_macro_1_73&ref_=aa_maas&tag=maas&aa_campaignid={campaignid}&aa_adgroupid={adgroupid}&aa_creativeid=ad-{creative}_{targetid}_dev-{device}_ext-{feeditemid}",
                "?maas=maas_adg_api_1964981050701_macro_2_73&ref_=aa_maas&tag=maas&aa_campaignid={{campaign.id}}&aa_adgroupid={{adset.id}}&aa_creativeid={{ad.id}}",
            ]),
            'publisher_identifier' => Str::random(),
        ];
    }
}
