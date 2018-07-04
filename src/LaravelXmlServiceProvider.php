<?php

namespace Bmatovu\LaravelXml;

use Bmatovu\LaravelXml\Http\XmlResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
         * Get the XML payload for the request.
         */
        Request::macro('xml', function () {
            return $this->getContent();
        });

        /**
         * Determine if the request is sending XML.
         *
         * @return bool
         */
        Request::macro('isXml', function () {
            return $this->getContentType() == 'xml';
        });

        /**
         * Determine if the current request is asking for XML in return.
         *
         * @return bool
         */
        Request::macro('wantsXml', function () {
            $acceptable = $this->getAcceptableContentTypes();
            return isset($acceptable[0]) && Str::contains($acceptable[0], ['/xml', '+xml']);
        });

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
        $this->app->bind('laravel-xml', function () {
            return new \Bmatovu\LaravelXml\Support\Facades\LaravelXml();
        });
    }

}