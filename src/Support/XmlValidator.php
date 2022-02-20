<?php

namespace Bmatovu\LaravelXml\Support;

use DOMDocument;

/**
 * Class XmlValidator.
 *
 * Validates XML against XSD
 *
 * @see ValidatingXML https://medium.com/@Sirolad/validating-xml-against-xsd-in-php-5607f725955a
 */
class XmlValidator
{
    /**
     * DOM Document.
     *
     * @var \DOMDocument
     */
    protected $domDocument = '';

    /**
     * XML Schema Definition.
     *
     * @var string
     */
    protected $xsd = '';

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->domDocument = new DOMDocument();
    }

    /**
     * Check if a string is valid XML.
     *
     * @see https://stackoverflow.com/a/31240779/2732184
     *
     * @param string $xmlStr
     * @param bool $ignoreHtml
     *
     * @return bool
     */
    public function is_valid($xmlStr, $ignoreHtml = true)
    {
        $xmlStr = trim($xmlStr);

        if ('' === $xmlStr) {
            return false;
        }

        if ($ignoreHtml && false !== stripos($xmlStr, '<!DOCTYPE html>')) {
            return false;
        }

        libxml_use_internal_errors(true);

        simplexml_load_string($xmlStr);

        $errors = libxml_get_errors();

        libxml_clear_errors();

        return empty($errors);
    }

    /**
     * Validate XML string.
     *
     * @see https://www.php.net/manual/en/class.simplexmlelement.php#107869
     *
     * @param string $xmlStr
     * @param string $xsdFilePath
     * @param int $flags
     * @param bool $checkXml
     *
     * @throws \Exception
     *
     * @return array
     */
    public function validate($xmlStr, $xsdFilePath, $flags = 0, $checkXml = false)
    {
        libxml_use_internal_errors(true);

        if ('' === $xmlStr || ($checkXml && ! $this->is_valid($xmlStr))) {
            throw new \Exception('Malformed XML.');
        }

        $this->domDocument->loadXML($xmlStr);

        $errors = [];
        if (! $this->domDocument->schemaValidate($xsdFilePath, $flags)) {
            foreach (libxml_get_errors() as $error) {
                $errors[$this->getElement($error->message)][] = $this->getMessage($error->message);
            }
            libxml_clear_errors();
        }

        return $errors;
    }

    /**
     * Get element from message.
     *
     * @param $message
     *
     * @return mixed
     */
    protected function getElement($message)
    {
        $matches = [];
        preg_match("/'([-_\\w]+)'/", $message, $matches);

        return array_pop($matches);
    }

    /**
     * Get refined message.
     *
     * @param $message
     *
     * @return string
     */
    protected function getMessage($message)
    {
        $parts = explode(':', $message);

        return trim(array_pop($parts));
    }
}
