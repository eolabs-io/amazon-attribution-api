<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Publishers;

use EolabsIo\AmazonAttributionApi\Domain\Publishers\Jobs\ProcessPublisherResponse;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Models\Publisher;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesPublishers;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessPublisherResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesPublishers;


    protected function setUp(): void
    {
        parent::setUp();

        $publishers = $this->createPublishers();

        $results = $publishers->fetch();

        (new ProcessPublisherResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_publishers_response()
    {
        $publisher = Publisher::first();

        $this->assertEquals($publisher->id, '1');
        $this->assertEquals($publisher->name, 'Google Ads');
        $this->assertTrue($publisher->macroEnabled);
    }
}
