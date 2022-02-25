<?php

namespace EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Models;

use EolabsIo\AmazonAttributionApi\Database\Factories\AttributionTagFactory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAttributionApiModel;

class AttributionTag extends AmazonAttributionApiModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'id',
                    'tag',
                    'publisher_identifier',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AttributionTagFactory::new();
    }
}
