<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Publishers\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Models\Publisher;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Actions\BasePersistAction;

class PersistPublisherAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'publishers';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Publisher);
        $attributes = [
            'id' => data_get($list, 'id'),
        ];

        $publisher = Publisher::updateOrCreate($attributes, $values);

        return $publisher;
    }
}
