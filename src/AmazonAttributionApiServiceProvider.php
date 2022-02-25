<?php

namespace EolabsIo\AmazonAttributionApi;

use Illuminate\Support\ServiceProvider;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Report;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Publisher;
use EolabsIo\AmazonAttributionApi\Domain\Reports\GoogleConversions;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\AttributionTag;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Command\PublisherCommand;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Command\ProductReportCommand;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Command\PerformanceReportCommand;
use EolabsIo\AmazonAttributionApi\Domain\Reports\Providers\ReportsServiceProvider;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Command\AttributionTagCommand;
use EolabsIo\AmazonAttributionApi\Domain\Publishers\Providers\PublishersServiceProvider;
use EolabsIo\AmazonAttributionApi\Domain\AttributionTags\Providers\AttributionTagsServiceProvider;

class AmazonAttributionApiServiceProvider extends ServiceProvider
{
    /**
      * Bootstrap the application services.
      */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (AmazonAttributionApi::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/amazonAttributionApi'),
            ], 'amazon-attribution-api-migrations');

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('amazon-attribution-api.php'),
            ], 'amazon-attribution-api-config');

            // Registering package commands.
            $this->commands([
                PerformanceReportCommand::class,
                ProductReportCommand::class,
                PublisherCommand::class,
                AttributionTagCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'amazon-attribution-api');

        $this->app->register(ReportsServiceProvider::class);
        $this->app->register(PublishersServiceProvider::class);
        $this->app->register(AttributionTagsServiceProvider::class);

        // Register the main class to use with the facade
        $this->app->singleton(Report::class, function () {
            return new Report();
        });

        $this->app->singleton(GoogleConversions::class, function () {
            return new GoogleConversions();
        });

        $this->app->singleton(Publisher::class, function () {
            return new Publisher();
        });

        $this->app->singleton(AttributionTag::class, function () {
            return new AttributionTag();
        });
    }
}
