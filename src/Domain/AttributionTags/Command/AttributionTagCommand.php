<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Command;

use Illuminate\Console\Command;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Models\Publisher;
use EolabsIo\AmazonAttributionApi\Support\Facades\AmazonAttributionTag;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Events\FetchAttributionTags;

class AttributionTagCommand extends Command
{
    protected $signature = 'amazon-attribution-api:attribution-tags
                            {--non-macro-tag : Gets a list of attribution tags for third-party publisher campaigns that do not support macros.}
                            {--publisher-ids=* : One or more publisher Ids to filter by.}
                            {--advertiser-ids=* : One or more advertiser Ids to filter by.}';


    protected $description = 'Gets Attribution Tags from Amazon Attribution API';


    public function handle()
    {
        $this->info('Geting Attribution Tags from Amazon Attribution API...');

        $nonMacroTag = $this->option('non-macro-tag');
        $publisherIds = $this->getPublisherIds($nonMacroTag);
        $advertiserIds = $this->option('advertiser-ids');

        $attributionTags = $this->getAmazonAttributionTag($nonMacroTag);
        $attributionTags->withPublisherIds($publisherIds);

        if ($advertiserIds) {
            $attributionTags->withAdvertiserIds($advertiserIds);
        }

        FetchAttributionTags::dispatch($attributionTags);
    }

    public function getPublisherIds(bool $isNonMacroTag): array
    {
        $optionPublisherIds = $this->option('publisher-ids');

        if ($optionPublisherIds) {
            return $optionPublisherIds;
        }

        return Publisher::where('macroEnabled', !$isNonMacroTag)->pluck('id')->toArray();
    }

    public function getAmazonAttributionTag(bool $isNonMacroTag)
    {
        if (!$isNonMacroTag) {
            return AmazonAttributionTag::withMacroTag();
        }

        if ($isNonMacroTag) {
            return AmazonAttributionTag::withNonMacroTag();
        }
    }
}
