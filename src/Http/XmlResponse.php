<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bmatovu\LaravelXml\Http;

use Bmatovu\LaravelXml\Support\ArrayToXml;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class XmlResponse extends BaseResponse
{
    use Macroable, ResponseTrait {
        Macroable::__call as macroCall;
    }

    public $headers = [];

    public $options = [
        'root' => 'document',
        'encoding' => 'UTF-8',
        'version' => '1.0',
        'slug' => true,
    ];

    /**
     * Constructor.
     *
     * @param mixed $data    The response data
     * @param int   $status  The response status code
     * @param array $headers An array of response headers
     * @param array $options
     */
    public function __construct($data = null, $status = 200, $headers = [], $options = [])
    {
        $this->headers = array_merge($this->headers, $headers);

        $this->options = array_merge($this->options, $options);

        if ($data instanceof Model || $data instanceof Collection) {
            $data = $data->toArray();
        }

        if (\is_array($data)) {
            $data = ArrayToXml::convert(
                $data,
                $this->options['root'],
                $this->options['slug'],
                $this->options['encoding'],
                $this->options['version']
            );
        }

        parent::__construct($data, $status, $headers);
    }

    /**
     * Set the content on the response.
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->header('Content-Type', 'text/xml');

        parent::setContent($content);

        return $this;
    }
}
