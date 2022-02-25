<?php

namespace EolabsIo\AmazonAttributionApi\Domain\Shared\Models;

use EolabsIo\AmazonAttributionApi\Domain\Shared\Models\AmazonAttributionApiModel;
use EolabsIo\AmazonAttributionApi\Database\Factories\AmazonAPIAuthorizationFactory;

class AmazonAPIAuthorization extends AmazonAttributionApiModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'amazon_api_authorizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'client_id',
                    'scope',
                    'refresh_token',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AmazonAPIAuthorizationFactory::new();
    }
}
