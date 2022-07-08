<?php

namespace Bmatovu\LaravelXml\Http;

use Bmatovu\LaravelXml\Support\ArrayToXml;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use SimpleXMLElement;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class XmlResponse extends BaseResponse
{
    use Macroable, ResponseTrait {
        Macroable::__call as macroCall;
    }

    /**
     * Constructor.
     *
     * @param mixed $data The response data
     * @param int $status The response status code
     * @param array $headers An array of response headers
     * @param array $options
     */
    public function __construct($data = null, $status = 200, $headers = [], $options = [])
    {
        $headers = array_merge(config('xml.headers'), $headers);

        if ($data instanceof SimpleXmlElement) {
            parent::__construct($data->asXML(), $status, $headers);

            return;
        }

        if ($data instanceof Model || $data instanceof Collection) {
            $data = $data->toArray();
        }

        if (\is_array($data)) {
            $data = ArrayToXml::convert(
                $data,
                $options['root'] ?? config('xml.root'),
                $options['case'] ?? config('xml.case'),
                $options['declaration']['version'] ?? config('xml.declaration.version'),
                $options['declaration']['encoding'] ?? config('xml.declaration.encoding'),
            );
        }

        parent::__construct($data, $status, $headers);
    }
}
