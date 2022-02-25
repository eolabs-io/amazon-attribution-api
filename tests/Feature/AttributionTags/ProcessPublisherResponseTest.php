<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\AttributionTags;

use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Jobs\ProcessAttributionTagsResponse;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Models\AttributionTag;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesAttributionTags;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessAttributionTagsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesAttributionTags;


    protected function setUp(): void
    {
        parent::setUp();

        $attributionTags = $this->createAttributionMacroTags();

        $results = $attributionTags->fetch();

        (new ProcessAttributionTagsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_attribution_tags_response()
    {
        $tag = AttributionTag::first();

        $this->assertEquals($tag->id, '1');
        $this->assertEquals($tag->tag, "?maas=maas_adg_api_1964981050701_macro_1_73&ref_=aa_maas&tag=maas&aa_campaignid={campaignid}&aa_adgroupid={adgroupid}&aa_creativeid=ad-{creative}_{targetid}_dev-{device}_ext-{feeditemid}");
        $this->assertEquals($tag->publisher_identifier, '1964981050701');
    }
}
