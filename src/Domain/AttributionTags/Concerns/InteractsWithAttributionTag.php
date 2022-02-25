<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Concerns;

trait InteractsWithAttributionTag
{
    /** @var string */
    private $tagType = 'macroTag';

    /** @var array */
    private $attributionTagParameters = [];


    public function withMacroTag(): self
    {
        $this->tagType = 'macroTag';

        return $this;
    }

    public function withNonMacroTag(): self
    {
        $this->tagType = 'nonMacroTemplateTag';

        return $this;
    }

    public function getAttributionTagType(): string
    {
        return $this->tagType;
    }

    public function withPublisherIds(array $publisherIds): self
    {
        $this->attributionTagParameters['publisherIds'] = implode(',', $publisherIds);

        return $this;
    }

    public function withAdvertiserIds(array $advertiserIds): self
    {
        $this->attributionTagParameters['advertiserIds'] = implode(',', $advertiserIds);

        return $this;
    }

    public function getAttributionTagParameters(): array
    {
        return $this->attributionTagParameters;
    }
}
