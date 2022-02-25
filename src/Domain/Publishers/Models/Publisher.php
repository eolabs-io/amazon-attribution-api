<?php
namespace EolabsIo\AmazonAttributionApi\Domain\Publishers\Models;

use EolabsIo\AmazonAttributionApi\Database\Factories\PublisherFactory;
use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAttributionApiModel;

class Publisher extends AmazonAttributionApiModel
{
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'macroEnabled' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'id',
                    'macroEnabled',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PublisherFactory::new();
    }
}
