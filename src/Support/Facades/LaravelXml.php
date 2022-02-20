<?php

namespace Bmatovu\LaravelXml\Support\Facades;

use Bmatovu\LaravelXml\Support\ArrayToXml;
use Bmatovu\LaravelXml\Support\JsonSimpleXMLElementDecorator;
use Bmatovu\LaravelXml\Support\XmlValidator;

class LaravelXml
{
    public function __construct()
    {
        // Silence is golden...
    }

    /**
     * Convert the an array to an xml string.
     *
     * @param string[] $arr
     * @param string   $rootElementName
     * @param bool     $replaceSpacesByUnderScoresInKeyNames
     * @param string   $xmlEncoding
     * @param string   $xmlVersion
     *
     * @return string
     */
    public function encode(
        $arr,
        $rootElementName = 'document',
        $replaceSpacesByUnderScoresInKeyNames = true,
        $xmlEncoding = 'UTF-8',
        $xmlVersion = '1.0'
    ) {
        return ArrayToXml::convert($arr, $rootElementName, $replaceSpacesByUnderScoresInKeyNames, $xmlEncoding, $xmlVersion);
    }

    /**
     * Convert a string of XML into an array.
     *
     * @see http://php.net/manual/en/function.simplexml-load-string.php
     * @see https://stackoverflow.com/a/20431742/2732184
     * @see https://stackoverflow.com/a/2970701/2732184
     *
     * @param string $data       A well-formed XML string
     * @param string $class_name Default: SimpleXMLElement
     * @param int    $options
     * @param string $ns         Namespace prefix or URI
     * @param bool   $is_prefix  TRUE if ns is a prefix, FALSE if it's a URI, defaults to FALSE
     *
     * @return mixed Array or FALSE on failure
     */
    public function decode($data, $class_name = 'SimpleXMLElement', $options = 0, $ns = '', $is_prefix = false)
    {
        $simple_xml = simplexml_load_string($data, $class_name, $options, $ns, $is_prefix);

        $json_simple_xml = new JsonSimpleXMLElementDecorator($simple_xml);

        return json_decode(json_encode($json_simple_xml), true);
    }

    /**
     * Check if a string is valid XML.
     *
     * @param string $xmlStr
     * @param bool   $ignoreHtml
     *
     * @return bool
     */
    public function is_valid($xmlStr, $ignoreHtml = true)
    {
        return (new XmlValidator())->is_valid($xmlStr, $ignoreHtml);
    }

    /**
     * Validate XML string.
     *
     * @param string $xmlStr
     * @param string $xsdFilePath
     * @param int    $flags
     * @param bool   $checkXml
     *
     * @return array Rrrors
     */
    public function validate($xmlStr, $xsdFilePath, $flags = 0, $checkXml = false)
    {
        return (new XmlValidator())->validate($xmlStr, $xsdFilePath, $flags, $checkXml);
    }
}
