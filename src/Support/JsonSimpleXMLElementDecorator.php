<?php

namespace Bmatovu\LaravelXml\Support;

use JsonSerializable;
use SimpleXMLElement;

/**
 * Class JsonSimpleXMLElementDecorator.
 *
 * @see https://hakre.wordpress.com/2013/07/09/simplexml-and-json-encode-in-php-part-i
 * @see https://gist.github.com/hakre/1d9e555ac1ebb1fc4ea8
 * @see https://gist.github.com/hakre/c36a66708259f54e564a
 */
class JsonSimpleXMLElementDecorator implements JsonSerializable
{
    const DEF_DEPTH = 512;

    /**
     * @var \SimpleXMLElement
     */
    protected $subject;

    /**
     * @var array
     */
    protected $options = [
        '@attributes' => true,
        '@text' => true,
        'depth' => self::DEF_DEPTH,
    ];

    /**
     * Constructor.
     */
    public function __construct(
        SimpleXMLElement $element,
        bool $useAttributes = true,
        bool $useText = true,
        int $depth = self::DEF_DEPTH
    ) {
        $this->subject = $element;

        if (null !== $useAttributes) {
            $this->useAttributes($useAttributes);
        }
        if (null !== $useText) {
            $this->useText($useText);
        }
        if (null !== $depth) {
            $this->setDepth($depth);
        }
    }

    /**
     * Should use attributes.
     *
     * @param bool $bool
     */
    public function useAttributes($bool): void
    {
        $this->options['@attributes'] = (bool) $bool;
    }

    /**
     * Should use text.
     *
     * @param bool $bool
     */
    public function useText($bool): void
    {
        $this->options['@text'] = (bool) $bool;
    }

    /**
     * Set depth.
     *
     * @param int $depth
     */
    public function setDepth($depth): void
    {
        $this->options['depth'] = (int) max(0, $depth);
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed Data which can be serialized by json_encode
     */
    public function jsonSerialize()
    {
        $subject = $this->subject;

        $array = [];

        // json encode attributes if any.
        if ($this->options['@attributes']) {
            if ($attributes = $subject->attributes()) {
                $array['@attributes'] = array_map('strval', iterator_to_array($attributes));
            }
        }

        // traverse into children if applicable
        $children = $subject;
        $this->options = (array) $this->options;
        $depth = $this->options['depth'] - 1;
        if ($depth <= 0) {
            $children = [];
        }

        // json encode child elements if any. group on duplicate names as an array.
        foreach ($children as $name => $element) {
            /** @var SimpleXMLElement $element */
            $decorator = new self($element);
            $decorator->options = ['depth' => $depth] + $this->options;

            if (isset($array[$name])) {
                if (! \is_array($array[$name])) {
                    $array[$name] = [$array[$name]];
                }
                $array[$name][] = $decorator;
            } else {
                $array[$name] = $decorator;
            }
        }

        // json encode non-whitespace element simplexml text values.
        $text = trim($subject);
        if (\strlen($text)) {
            if ($array) {
                $this->options['@text'] && $array['@text'] = $text;
            } else {
                $array = $text;
            }
        }

        // return empty elements as NULL (self-closing or empty tags)
        if (! $array && '0' !== $array) {
            $array = null;
        }

        return $array;
    }
}
