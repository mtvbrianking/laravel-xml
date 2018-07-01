<?php

namespace Bmatovu\LaravelXml\Http;

use Bmatovu\LaravelXml\Support\ArrayToXml;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Traits\Macroable;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class XmlResponse extends BaseResponse
{

    use ResponseTrait, Macroable {
        Macroable::__call as macroCall;
    }

    public $headers = array();

    public $options = array(
        'root' => 'document',
        'encoding' => 'UTF-8',
        'version' => '1.0',
        'slug' => true,
    );

    /**
     * Constructor.
     *
     * @param mixed $data array|xml string
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return void
     */
    public function __construct($data = null, $status = 200, $headers = [], $options = [])
    {
        $this->headers = array_merge($this->headers, $headers);

        $this->options = array_merge($this->options, $options);

        parent::__construct($data, $status, $headers);
    }

    /**
     * Set the content on the response.
     *
     * @param  mixed $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->header('Content-Type', 'text/xml');

        if (is_array($content)) {

            $xml = ArrayToXml::convert(
                $content,
                $this->options['root'],
                $this->options['slug'],
                $this->options['encoding'],
                $this->options['version']
            );

            parent::setContent($xml);
            return $this;
        }

        parent::setContent($content);

        return $this;
    }

}