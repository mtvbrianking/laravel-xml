<?php

namespace Bmatovu\LaravelXml\Support;

use DOMDocument;
use DOMElement;
use DOMException;

/**
 * Convert PHP Array to XML.
 *
 * Class ArrayToXml
 *
 * @license MIT
 *
 * @see https://github.com/spatie/array-to-xml
 */
class ArrayToXml
{
    /**
     * The root DOM Document.
     *
     * @var DOMDocument
     */
    protected $document;

    /**
     * Set to enable replacing space with underscore.
     *
     * @var bool
     */
    protected $replaceSpacesByUnderScoresInKeyNames = true;

    /**
     * Construct a new instance.
     *
     * @param array|string $rootElement
     * @param bool         $replaceSpacesByUnderScoresInKeyNames
     * @param string       $xmlEncoding
     * @param string       $xmlVersion
     *
     * @throws DOMException
     */
    public function __construct(
        array $content,
        $rootElement = '',
        $replaceSpacesByUnderScoresInKeyNames = true,
        $xmlEncoding = 'UTF-8',
        $xmlVersion = '1.0'
    ) {
        $this->document = new DOMDocument($xmlVersion, $xmlEncoding);
        $this->replaceSpacesByUnderScoresInKeyNames = $replaceSpacesByUnderScoresInKeyNames;

        if ($this->isArrayAllKeySequential($content) && ! empty($content)) {
            throw new DOMException('Invalid Character Error');
        }

        $root = $this->createRootElement($rootElement);

        $this->document->appendChild($root);

        $this->convertElement($root, $content);
    }

    /**
     * Convert the given array to an xml string.
     *
     * @param string[] $array
     * @param string   $rootElementName
     * @param bool     $replaceSpacesByUnderScoresInKeyNames
     * @param string   $xmlEncoding
     * @param string   $xmlVersion
     *
     * @return string
     */
    public static function convert(
        array $array,
        $rootElementName = 'document',
        $replaceSpacesByUnderScoresInKeyNames = true,
        $xmlEncoding = 'UTF-8',
        $xmlVersion = '1.0'
    ) {
        $converter = new static($array, $rootElementName, $replaceSpacesByUnderScoresInKeyNames, $xmlEncoding, $xmlVersion);

        return $converter->toXml();
    }

    /**
     * Return as XML.
     *
     * @return string
     */
    public function toXml()
    {
        return $this->document->saveXML();
    }

    /**
     * Return as DOM object.
     *
     * @return DOMDocument
     */
    public function toDom()
    {
        return $this->document;
    }

    /**
     * Add node.
     *
     * @param string $key
     * @param array  $value
     */
    protected function addNode(DOMElement $element, $key, $value): void
    {
        if ($this->replaceSpacesByUnderScoresInKeyNames) {
            $key = str_replace(' ', '_', $key);
        }

        $child = $this->document->createElement($key);
        $element->appendChild($child);
        $this->convertElement($child, $value);
    }

    /**
     * Add collection node.
     *
     * @param array $value
     */
    protected function addCollectionNode(DOMElement $element, $value): void
    {
        if (0 === $element->childNodes->length && 0 === $element->attributes->length) {
            $this->convertElement($element, $value);

            return;
        }

        $child = new DOMElement($element->tagName);
        $element->parentNode->appendChild($child);
        $this->convertElement($child, $value);
    }

    /**
     * Add sequential node.
     *
     * @param array $value
     */
    protected function addSequentialNode(DOMElement $element, $value): void
    {
        if (empty($element->nodeValue)) {
            $element->nodeValue = htmlspecialchars($value);

            return;
        }

        $child = new DOMElement($element->tagName);
        $child->nodeValue = htmlspecialchars($value);
        $element->parentNode->appendChild($child);
    }

    /**
     * Check if array are all sequential.
     *
     * @param array $value
     *
     * @return bool
     */
    protected function isArrayAllKeySequential($value)
    {
        if (! \is_array($value)) {
            return false;
        }

        if (\count($value) <= 0) {
            return true;
        }

        return array_unique(array_map('is_int', array_keys($value))) === [true];
    }

    /**
     * Add attributes.
     *
     * @param DOMElement $element
     * @param string[]   $data
     */
    protected function addAttributes($element, $data): void
    {
        foreach ($data as $attrKey => $attrVal) {
            $element->setAttribute($attrKey, $attrVal);
        }
    }

    /**
     * Create the root element.
     *
     * @param array|string $rootElement
     *
     * @return DOMElement
     */
    protected function createRootElement($rootElement)
    {
        if (\is_string($rootElement)) {
            $rootElementName = $rootElement ?: 'root';

            return $this->document->createElement($rootElementName);
        }

        $rootElementName = isset($rootElement['rootElementName']) ? $rootElement['rootElementName'] : 'root';

        $element = $this->document->createElement($rootElementName);

        foreach ($rootElement as $key => $value) {
            if ('_attributes' !== $key && '@attributes' !== $key) {
                continue;
            }

            $this->addAttributes($element, $rootElement[$key]);
        }

        return $element;
    }

    /**
     * Parse individual element.
     *
     * @param array $value
     */
    protected function convertElement(DOMElement $element, $value): void
    {
        $sequential = $this->isArrayAllKeySequential($value);

        if (! \is_array($value)) {
            $element->nodeValue = htmlspecialchars($value);

            return;
        }

        foreach ($value as $key => $data) {
            if (! $sequential) {
                if (('_attributes' === $key) || ('@attributes' === $key)) {
                    $this->addAttributes($element, $data);
                } elseif ((('_value' === $key) || ('@value' === $key)) && \is_string($data)) {
                    $element->nodeValue = htmlspecialchars($data);
                } elseif ((('_cdata' === $key) || ('@cdata' === $key)) && \is_string($data)) {
                    $element->appendChild($this->document->createCDATASection($data));
                } else {
                    $this->addNode($element, $key, $data);
                }
            } elseif (\is_array($data)) {
                $this->addCollectionNode($element, $data);
            } else {
                $this->addSequentialNode($element, $data);
            }
        }
    }
}
