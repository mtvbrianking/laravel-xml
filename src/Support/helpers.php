<?php

use Bmatovu\LaravelXml\Support\ArrayToXml;

//if (!function_exists('xml_encode')) {
    /**
     * Convert the an array to an xml string
     *
     * @param string[] $array
     * @param string $rootElementName
     * @param bool $replaceSpacesByUnderScoresInKeyNames
     * @param string $xmlEncoding
     * @param string $xmlVersion
     *
     * @return string
     */
    function xml_encode(array $array, $rootElementName = 'document', $replaceSpacesByUnderScoresInKeyNames = true, $xmlEncoding = 'UTF-8', $xmlVersion = '1.0')
    {
        return ArrayToXml::convert($array, $rootElementName, $replaceSpacesByUnderScoresInKeyNames, $xmlEncoding, $xmlVersion);
    }
//}

//if (!function_exists('xml_decode')) {
    /**
     * Convert a string of XML into an array
     *
     * @link http://php.net/manual/en/function.simplexml-load-string.php
     * @link https://stackoverflow.com/a/20431742/2732184
     * @link https://stackoverflow.com/a/2970701/2732184
     * @param string $data A well-formed XML string
     * @param string $class_name [optional] Default: SimpleXMLElement
     * @param int $options
     * @param string $ns [optional] Namespace prefix or URI.
     * @param bool $is_prefix [optional] TRUE if ns is a prefix, FALSE if it's a URI, defaults to FALSE
     * @return mixed Array or FALSE on failure
     */
    function xml_decode($data, $class_name = "SimpleXMLElement", $options = 0, $ns = "", $is_prefix = false)
    {
        $simple_xml = simplexml_load_string($data, $class_name, $options, $ns, $is_prefix);
        return json_decode(json_encode($simple_xml), true);
    }
//}

// TODO

// validate_xml

// is valid_xml