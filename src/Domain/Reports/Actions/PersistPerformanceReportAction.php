<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Reports\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Models\PerformanceReport;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Actions\BasePersistAction;

class PersistPerformanceReportAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'reports';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new PerformanceReport);
        $attributes = [
            'date' => data_get($list, 'date'),
            'campaignId' => data_get($list, 'campaignId'),
            'adGroupId' => data_get($list, 'adGroupId'),
            'creativeId' => data_get($list, 'creativeId'),
        ];

        $performanceReport = PerformanceReport::updateOrCreate($attributes, $values);

        return $performanceReport;
    }
}
