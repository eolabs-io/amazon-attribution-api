<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Publishers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Events\FetchPublisher;

class PublishersCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_publishers_artisan_command()
    {
        $this->artisan('amazon-attribution-api:publishers')
             ->assertExitCode(0);

        // Assert that job was called
        Event::assertDispatched(FetchPublisher::class);
    }
}
