<?php

namespace Bmatovu\LaravelXml;

use Bmatovu\LaravelXml\Http\XmlResponse;
use Bmatovu\LaravelXml\Support\Facades\LaravelXml;
use Bmatovu\LaravelXml\Support\XmlElement;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LaravelXmlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /*
         * Determine if the request is sending XML.
         *
         * @return bool
         */
        Request::macro('isXml', function () {
            return 'xml' === $this->getContentType();
        });

        /*
         * Get the XML payload for the request.
         *
         * @return \Bmatovu\LaravelXml\Support\XmlElement
         */
        Request::macro('xml', function () {
            if (! $this->isXml() || ! $content = $this->getContent()) {
                return new XmlElement('<root></root>');
            }

            return simplexml_load_string($content, XmlElement::class);
        });

        /*
         * Determine if the current request is asking for XML in return.
         *
         * @return bool
         */
        Request::macro('wantsXml', function () {
            $acceptable = $this->getAcceptableContentTypes();

            return isset($acceptable[0]) && Str::contains($acceptable[0], ['/xml', '+xml']);
        });

        /*
         * Return a new XML response from the application.
         *
         * @param  string|array $data
         * @param  int $status
         * @param  array $headers
         * @param  array $options
         * @return \Bmatovu\LaravelXml\Http\XmlResponse
         */
        Response::macro('xml', function ($data, $status = 200, array $headers = [], $options = []) {
            return new XmlResponse($data, $status, $headers, $options);
        });
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->bind('laravel-xml', function () {
            return new LaravelXml();
        });
    }
}
