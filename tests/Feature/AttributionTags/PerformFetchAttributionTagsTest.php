<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\AttributionTags;

use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Jobs\PerformFetchAttributionTags;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Jobs\ProcessAttributionTagsResponse;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesAttributionTags;

class PerformFetchAttributionTagsTest extends TestCase
{
    use CreatesAttributionTags;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        $attributionTags = $this->createAttributionMacroTags();

        PerformFetchAttributionTags::dispatch($attributionTags);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchAttributionTags::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessAttributionTagsResponse::class, function ($job) {
            return data_get($job->results, '1964981050701.1') === "?maas=maas_adg_api_1964981050701_macro_1_73&ref_=aa_maas&tag=maas&aa_campaignid={campaignid}&aa_adgroupid={adgroupid}&aa_creativeid=ad-{creative}_{targetid}_dev-{device}_ext-{feeditemid}";
        });
    }

    /** @test */
    public function it_calls_the_correct_non_macro_job()
    {
        $attributionTags = $this->createAttributionNonMacroTags();

        PerformFetchAttributionTags::dispatch($attributionTags);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchAttributionTags::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessAttributionTagsResponse::class, function ($job) {
            return data_get($job->results, '1964981050701.5') === "?maas=maas_adg_api_1964981050701_static_5_73&ref_=aa_maas&tag=maas&aa_campaignid={insertCampaign}&aa_adgroupid={insertAdGroupId}&aa_creativeid={insertCreativeId}";
        });
    }
}
