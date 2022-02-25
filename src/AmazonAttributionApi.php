<?php

namespace EolabsIo\AmazonAttributionApi;

class AmazonAttributionApi
{
    /**
     * Indicates if migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = false;


    /**
     * Configure to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }

    /**
     * Configure to not register its migrations.
     *
     * @return static
     */
    public static function shouldRunMigrations()
    {
        static::$runsMigrations = true;

        return new static;
    }
}
