<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Publishers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionTag;
use EolabsIo\AmazonAttributionApi\Tests\Factories\AmazonAttributionTagFactory;

class AmazonAttributionTagTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_macro_tag_request_query()
    {
        AmazonAttributionTagFactory::new()->fakeMacroTagResponse();

        $publisherIds = [1,2,3,4];
        $advertiserIds = [1234,5678];

        AmazonAttributionTag::withMacroTag()
            ->withPublisherIds($publisherIds)
            ->withAdvertiserIds($advertiserIds)
            ->fetch();

        Http::assertSent(function ($request) {
            return Str::startsWith($request->url(), "https://advertising-api.amazon.com/attribution/tags/macroTag") &&
                   $request->method() == "GET" &&

            // Headers
                    $request->hasHeader('Amazon-Advertising-API-ClientId', 'amzn1.application-oa2-client.a925EXAMPLE0b302baf3e644a') &&
                    $request->hasHeader('Authorization', 'Bearer Atza|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
                    $request->hasHeader('Amazon-Advertising-API-Scope', 1234567890) &&

            // parameters
                    $request['publisherIds'] == '1,2,3,4' &&
                    $request['advertiserIds'] == '1234,5678';
        });
    }

    /** @test */
    public function it_gets_the_correct_macro_tag_response()
    {
        AmazonAttributionTagFactory::new()->fakeMacroTagResponse();

        $publisherIds = [1,2,3,4];

        $response = AmazonAttributionTag::withMacroTag()
            ->withPublisherIds($publisherIds)
            ->fetch();

        $publisherIdentifier = $response->keys()->first();
        $tags = $response[$publisherIdentifier];

        $this->assertCount(4, $tags);

        $id = array_key_first($tags);
        $tag = $tags[$id];

        $this->assertEquals(1, $id);
        $this->assertEquals("?maas=maas_adg_api_1964981050701_macro_1_73&ref_=aa_maas&tag=maas&aa_campaignid={campaignid}&aa_adgroupid={adgroupid}&aa_creativeid=ad-{creative}_{targetid}_dev-{device}_ext-{feeditemid}", $tag);
    }

    /** @test */
    public function it_sends_the_correct_non_macro_tag_request_query()
    {
        AmazonAttributionTagFactory::new()->fakeNonMacroTagResponse();

        $publisherIds = [5,6,7,8,9];
        $advertiserIds = [5678, 1234];

        AmazonAttributionTag::withNonMacroTag()
            ->withPublisherIds($publisherIds)
            ->withAdvertiserIds($advertiserIds)
            ->fetch();

        Http::assertSent(function ($request) {
            return Str::startsWith($request->url(), "https://advertising-api.amazon.com/attribution/tags/nonMacroTemplateTag") &&
                       $request->method() == "GET" &&

                // Headers
                        $request->hasHeader('Amazon-Advertising-API-ClientId', 'amzn1.application-oa2-client.a925EXAMPLE0b302baf3e644a') &&
                        $request->hasHeader('Authorization', 'Bearer Atza|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
                        $request->hasHeader('Amazon-Advertising-API-Scope', 1234567890) &&

                // parameters
                        $request['publisherIds'] == '5,6,7,8,9' &&
                        $request['advertiserIds'] == '5678,1234';
        });
    }

    /** @test */
    public function it_gets_the_correct_non_macro_tag_response()
    {
        AmazonAttributionTagFactory::new()->fakeNonMacroTagResponse();

        $publisherIds = [5,6,7,8,9];
        $advertiserIds = [5678, 1234];

        $response = AmazonAttributionTag::withNonMacroTag()
            ->withPublisherIds($publisherIds)
            ->withAdvertiserIds($advertiserIds)
            ->fetch();

        $publisherIdentifier = $response->keys()->first();
        $tags = $response[$publisherIdentifier];

        $this->assertCount(4, $tags);

        $id = array_key_first($tags);
        $tag = $tags[$id];

        $this->assertEquals(5, $id);
        $this->assertEquals("?maas=maas_adg_api_1964981050701_static_5_73&ref_=aa_maas&tag=maas&aa_campaignid={insertCampaign}&aa_adgroupid={insertAdGroupId}&aa_creativeid={insertCreativeId}", $tag);
    }
}
