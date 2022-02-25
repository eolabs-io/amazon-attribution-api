<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Models\AttributionTag;

class PersistAttributionTagsAction
{

   /** @var array */
    private $list;

    public function __construct($list)
    {
        $this->list = $list;
    }

    public function execute()
    {
        foreach ($this->list as $publisherIdentifier => $tags) {
            $this->createFromList($publisherIdentifier, $tags);
        }
    }

    private function createFromList($publisherIdentifier, $tags)
    {
        foreach ($tags as $id => $tag) {
            $item = $this->createItem($publisherIdentifier, $id, $tag);
        }
    }

    protected function createItem($publisherIdentifier, $id, $tag): Model
    {
        $values = [
            'id' => $id,
            'tag' => $tag,
            'publisher_identifier' => $publisherIdentifier,
        ];

        $attributes = $values;

        $attributionTag = AttributionTag::updateOrCreate($attributes, $values);

        return $attributionTag;
    }
}
