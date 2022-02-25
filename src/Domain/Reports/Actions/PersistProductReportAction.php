<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\ProductReport;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Actions\BasePersistAction;

class PersistProductReportAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'reports';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new ProductReport);
        $attributes = [
            'date' => data_get($list, 'date'),
            'campaignId' => data_get($list, 'campaignId'),
            'adgroupId' => data_get($list, 'adgroupId'),
        ];

        $productReport = ProductReport::updateOrCreate($attributes, $values);

        return $productReport;
    }
}
