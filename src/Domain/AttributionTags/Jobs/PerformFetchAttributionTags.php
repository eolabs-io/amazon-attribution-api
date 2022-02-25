<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTag;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Jobs\ProcessAttributionTagsResponse;

class PerformFetchAttributionTags implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTag */
    public $attributionTag;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AttributionTag $attributionTag)
    {
        $this->attributionTag = $attributionTag;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->attributionTag->fetch();

        ProcessAttributionTagsResponse::dispatch($results);
    }
}
