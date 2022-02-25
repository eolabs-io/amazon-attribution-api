<?php

namespace EolabsIo\AmazonAttributionApi\Tests;

use Illuminate\Support\Facades\Event;
use Orchestra\Testbench\TestCase as Orchestra;
use EolabsIo\AmazonAttributionApi\AmazonAttributionApiServiceProvider;

abstract class TestCase extends Orchestra
{
    public $initialEvent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(realpath(dirname(__DIR__) .'/database/migrations'));

        $this->initialEvent = Event::getFacadeRoot();
        Event::fake();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('amazon-attribution-api.clientId', env('AMAZON_ADVERTISING_API_CLIENTID'));
        $app['config']->set('amazon-attribution-api.clientSecret', env('AMAZON_ADVERTISING_API_CLIENTSECRET'));
    }

    /**
     * Get package providers.  At a minimum this is the package being tested, but also
     * would include packages upon which our package depends, e.g. Cartalyst/Sentry
     * In a normal app environment these would be added to the 'providers' array in
     * the config/app.php file.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            AmazonAttributionApiServiceProvider::class,
        ];
    }
    /**
     * Get package aliases.  In a normal app environment these would be added to
     * the 'aliases' array in the config/app.php file.  If your package exposes an
     * aliased facade, you should add the alias here, along with aliases for
     * facades upon which your package depends, e.g. Cartalyst/Sentry.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    // protected function getPackageAliases($app)
    // {
    //     return [
    //         // 'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
    //     ];
    // }
}
