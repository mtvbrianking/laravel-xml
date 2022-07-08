<?php

use Bmatovu\LaravelXml\Support\ArrayToXml;
use Bmatovu\LaravelXml\Support\JsonSimpleXMLElementDecorator;
use Bmatovu\LaravelXml\Support\XmlValidator;

if (! function_exists('xml_encode')) {
    /**
     * Convert the an array to an xml string.
     *
     * @param string[] $array
     * @param string $rootElementName
     * @param string $elementCase
     * @param string $xmlVersion
     * @param string $xmlEncoding
     *
     * @return string
     */
    function xml_encode(array $array, $rootElementName = 'document', $elementCase = 'slug', $xmlVersion = '1.0', $xmlEncoding = 'UTF-8')
    {
        return ArrayToXml::convert($array, $rootElementName, $elementCase, $xmlVersion, $xmlEncoding);
    }
}

if (! function_exists('xml_decode')) {
    /**
     * Convert a string of XML into an array.
     *
     * @see http://php.net/manual/en/function.simplexml-load-string.php
     * @see https://stackoverflow.com/a/20431742/2732184
     * @see https://stackoverflow.com/a/2970701/2732184
     *
     * @param string $data A well-formed XML string
     * @param string $class_name [optional] Default: SimpleXMLElement
     * @param int $options
     * @param string $namespace_or_prefix [optional] Namespace prefix or URI
     * @param bool $is_prefix [optional] TRUE if ns is a prefix, FALSE if it's a URI, defaults to FALSE
     *
     * @return mixed Array or FALSE on failure
     */
    function xml_decode($data, $class_name = SimpleXMLElement::class, $options = 0, $namespace_or_prefix = '', $is_prefix = false)
    {
        $simple_xml = simplexml_load_string($data, $class_name, $options, $namespace_or_prefix, $is_prefix);

        $json_simple_xml = new JsonSimpleXMLElementDecorator($simple_xml);

        return json_decode(json_encode($json_simple_xml), true);
    }
}

if (! function_exists('is_valid_xml')) {
    /**
     * Check if a string is valid XML.
     *
     * @param string $xml
     *
     * @return bool
     */
    function is_valid_xml($xml)
    {
        $validator = new XmlValidator();

        return $validator->is_valid($xml);
    }
}

if (! function_exists('validate_xml')) {
    /**
     * Validate XML string.
     *
     * @param string $xml
     * @param string $xsd file
     *
     * @return array errors
     */
    function validate_xml($xml, $xsd)
    {
        $validator = new XmlValidator();

        return $validator->validate($xml, $xsd);
    }
}
