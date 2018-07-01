<?php

namespace Bmatovu\LaravelXml;

use Bmatovu\LaravelXml\Http\XmlResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class LaravelXmlServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Return a new XML response from the application.
         *
         * @param  string|array $data
         * @param  int $status
         * @param  array $headers
         * @param  int $options
         * @return string BaseXmlResponse
         */
        Response::macro('xml', function ($data, $status = 200, array $headers = [], $options = []) {
            return new XmlResponse($data, $status, $headers, $options);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind facade
        $this->app->bind('laravel-xml', function(){
            return new \Bmatovu\LaravelXml\Support\Facades\LaravelXml();
        });
    }

}