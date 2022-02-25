<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Publishers\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher;

class PerformFetchPublisher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher */
    public $publisher;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->publisher->fetch();

        ProcessPublisherResponse::dispatch($results);
    }
}
