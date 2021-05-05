<?php

namespace Bmatovu\LaravelXml\Test;

use Bmatovu\LaravelXml\LaravelXmlServiceProvider;
use Bmatovu\LaravelXml\Support\XmlElement;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // $this->app['router']->post('/resources', function() {});
    }

    /**
     * Add package service provider.
     *
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelXmlServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            // 'Xml' => 'Bmatovu\LaravelXml\LaravelXml',
        ];
    }

    /**
     * Define routes setup.
     *
     * @param \Illuminate\Routing\Router $router
     */
    protected function defineRoutes($router)
    {
        $router->post('/resources', function () {
            $xmlElement = new XmlElement('<document><alias>jdoe</alias></document>');

            return response()->xml($xmlElement);
        });
    }
}
