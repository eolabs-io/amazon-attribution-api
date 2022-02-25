<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Feature\Publishers;

use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonAttributionApi\Tests\TestCase;
use EolabsIo\AmazonAttributionApi\Tests\Concerns\CreatesPublishers;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Jobs\PerformFetchPublisher;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Jobs\ProcessPublisherResponse;

class PerformFetchPublisherTest extends TestCase
{
    use CreatesPublishers;

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
        $publisher = $this->createPublishers();

        PerformFetchPublisher::dispatch($publisher);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchPublisher::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessPublisherResponse::class, function ($job) {
            return data_get($job->results, 'publishers.0.id') === '1';
        });
    }
}
