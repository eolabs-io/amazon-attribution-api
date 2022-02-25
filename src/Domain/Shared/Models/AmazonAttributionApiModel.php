<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class AmazonAttributionApiModel extends Model
{
    use HasFactory;

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName()
    {
        return config('amazon-attribution-api.database.connection') ?? $this->connection;
    }
}
