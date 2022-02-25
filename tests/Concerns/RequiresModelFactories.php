<?php

namespace EolabsIo\AmazonAttributionApi\Tests\Concerns;

trait RequiresModelFactories
{
    public function factory($number=0)
    {
        $modelClass = $this->getModelClass();

        return ($number > 0) ? factory($modelClass, $number) : factory($modelClass);
    }

    protected function newModelInstance()
    {
        $className = $this->getModelClass();
        return $this->newInstance($className);
    }

    protected function newInstance($className)
    {
        return new $className();
    }

    abstract protected function getModelClass();

    public function getPrimaryKeyValuePair($model)
    {
        $primaryKeyName = $this->getPrimaryKeyName($model);
        $primaryKeyValue = $this->getPrimaryKeyValue($model);

        return [$primaryKeyName => $primaryKeyValue];
    }

    public function getPrimaryKeyValue($model)
    {
        return $model->getKey();
    }

    public function getPrimaryKeyName($model)
    {
        return $model->getKeyName();
    }

    protected function removePrimaryKeyFromModel($model)
    {
        $keys = $this->getPrimaryKeyName($model);

        $primaryKeys = (is_array($keys)) ? $keys : array($keys);

        $data = collect($model->toArray())->except($primaryKeys);

        return $data->toArray();
    }
}
