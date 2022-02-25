<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\AttributionTags;

use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Events\FetchAttributionTags;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;

class AttributionTagsCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_attribution_tags_artisan_command()
    {
        $this->artisan('amazon-attribution-api:attribution-tags')
             ->assertExitCode(0);

        // Assert that job was called
        Event::assertDispatched(FetchAttributionTags::class);
    }
}
