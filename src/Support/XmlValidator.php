<?php

namespace Bmatovu\LaravelXml\Support;

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
     * @var DOMDocument
     */
    protected $doc = '';

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
        $this->doc = new \DOMDocument();
    }

    /**
     * Check if a string is valid XML.
     *
     * @see https://stackoverflow.com/a/31240779/2732184
     *
     * @param string $xml
     *
     * @return bool
     */
    public function is_valid($xml)
    {
        $content = trim($xml);
        if (empty($content)) {
            return false;
        }

        // ignore html
        if (false !== stripos($content, '<!DOCTYPE html>')) {
            return false;
        }

        libxml_use_internal_errors(true);

        simplexml_load_string($content);

        $errors = libxml_get_errors();

        libxml_clear_errors();

        return empty($errors);
    }

    /**
     * Validate XML string.
     *
     * @param string $xml
     * @param string $xsd file
     *
     * @return array
     */
    public function validate($xml, $xsd)
    {
        libxml_use_internal_errors(true);

        if (! $this->is_valid($xml)) {
            return ['error' => 'Invalid xml'];
        }

        $this->doc->loadXML($xml);

        $errors = [];
        if (! $this->doc->schemaValidate($xsd)) {
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
