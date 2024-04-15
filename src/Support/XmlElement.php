<?php

namespace Bmatovu\LaravelXml\Support;

class XmlElement extends \SimpleXMLElement
{
    /**
     * Provides access to element's children.
     *
     * With chance for default value.
     *
     * @param string $attr Attribute
     * @param mixed $default Default Value
     *
     * @return mixed
     */
    public function get($attr, $default = null)
    {
        if (is_null($this->{$attr})) {
            return $default;
        }

        return $this->{$attr};
    }
}
