<?php

namespace Bmatovu\LaravelXml\Support;

use DOMDocument;
use DOMElement;
use DOMException;

/**
 * @see https://github.com/spatie/array-to-xml
 */
class ArrayToXml
{
    /**
     * The DOM Document.
     *
     * @var \DOMDocument
     */
    protected $domDocument;

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
     * @throws \DOMException
     */
    public function __construct(
        array $content,
        $rootElement = '',
        $replaceSpacesByUnderScoresInKeyNames = true,
        $xmlEncoding = 'UTF-8',
        $xmlVersion = '1.0'
    ) {
        $this->domDocument = new DOMDocument($xmlVersion, $xmlEncoding);
        $this->replaceSpacesByUnderScoresInKeyNames = $replaceSpacesByUnderScoresInKeyNames;

        if ($this->isArrayAllKeySequential($content) && ! empty($content)) {
            throw new DOMException('Invalid Character Error');
        }

        $root = $this->createRootElement($rootElement);

        $this->domDocument->appendChild($root);

        $this->convertElement($root, $content);
    }

    /**
     * Convert the given array to an xml string.
     *
     * @param string[] $arr
     * @param string   $rootElementName
     * @param bool     $replaceSpacesByUnderScoresInKeyNames
     * @param string   $xmlEncoding
     * @param string   $xmlVersion
     *
     * @return string
     */
    public static function convert(
        array $arr,
        $rootElementName = 'document',
        $replaceSpacesByUnderScoresInKeyNames = true,
        $xmlEncoding = 'UTF-8',
        $xmlVersion = '1.0'
    ) {
        $converter = new static($arr, $rootElementName, $replaceSpacesByUnderScoresInKeyNames, $xmlEncoding, $xmlVersion);

        return $converter->toXml();
    }

    /**
     * Return as XML.
     *
     * @return string
     */
    public function toXml()
    {
        return $this->domDocument->saveXML();
    }

    /**
     * Return as DOM object.
     *
     * @return \DOMDocument
     */
    public function toDom()
    {
        return $this->domDocument;
    }

    /**
     * Add node.
     *
     * @param string $key
     * @param array  $value
     */
    protected function addNode(DOMElement $domElement, $key, $value): void
    {
        if ($this->replaceSpacesByUnderScoresInKeyNames) {
            $key = str_replace(' ', '_', $key);
        }

        $child = $this->domDocument->createElement($key);
        $domElement->appendChild($child);
        $this->convertElement($child, $value);
    }

    /**
     * Add collection node.
     *
     * @param array $value
     */
    protected function addCollectionNode(DOMElement $domElement, $value): void
    {
        if (0 === $domElement->childNodes->length && 0 === $domElement->attributes->length) {
            $this->convertElement($domElement, $value);

            return;
        }

        $child = new DOMElement($domElement->tagName);
        $domElement->parentNode->appendChild($child);
        $this->convertElement($child, $value);
    }

    /**
     * Add sequential node.
     *
     * @param array $value
     */
    protected function addSequentialNode(DOMElement $domElement, $value): void
    {
        if (empty($domElement->nodeValue)) {
            $domElement->nodeValue = htmlspecialchars($value);

            return;
        }

        $child = new DOMElement($domElement->tagName);
        $child->nodeValue = htmlspecialchars($value);
        $domElement->parentNode->appendChild($child);
    }

    /**
     * Check if all array keys are sequential.
     *
     * @param array|string $value
     *
     * @return bool
     */
    protected function isArrayAllKeySequential($value)
    {
        if (! \is_array($value)) {
            return false;
        }

        if (0 === \count($value)) {
            return true;
        }

        return array_unique(array_map('is_int', array_keys($value))) === [true];
    }

    /**
     * Add attributes.
     *
     * @param \DOMElement $domElement
     * @param string[]    $data
     */
    protected function addAttributes($domElement, $data): void
    {
        foreach ($data as $attrKey => $attrVal) {
            $domElement->setAttribute($attrKey, $attrVal);
        }
    }

    /**
     * Create the root element.
     *
     * @param array|string $rootElement
     *
     * @return \DOMElement
     */
    protected function createRootElement($rootElement)
    {
        if (\is_string($rootElement)) {
            $rootElementName = $rootElement ?: 'root';

            return $this->domDocument->createElement($rootElementName);
        }

        $rootElementName = isset($rootElement['rootElementName']) ? $rootElement['rootElementName'] : 'root';

        $domElement = $this->domDocument->createElement($rootElementName);

        foreach ($rootElement as $key => $value) {
            if ('_attributes' !== $key && '@attributes' !== $key) {
                continue;
            }

            $this->addAttributes($domElement, $rootElement[$key]);
        }

        return $domElement;
    }

    /**
     * Parse individual element.
     *
     * @param array|string $value
     */
    protected function convertElement(DOMElement $domElement, $value): void
    {
        $sequential = $this->isArrayAllKeySequential($value);

        if (! \is_array($value)) {
            $domElement->nodeValue = htmlspecialchars($value);

            return;
        }

        foreach ($value as $key => $data) {
            if (! $sequential) {
                if (('_attributes' === $key) || ('@attributes' === $key)) {
                    $this->addAttributes($domElement, $data);
                } elseif ((('_value' === $key) || ('@value' === $key)) && \is_string($data)) {
                    $domElement->nodeValue = htmlspecialchars($data);
                } elseif ((('_cdata' === $key) || ('@cdata' === $key)) && \is_string($data)) {
                    $domElement->appendChild($this->domDocument->createCDATASection($data));
                } else {
                    $this->addNode($domElement, $key, $data);
                }
            } elseif (\is_array($data)) {
                $this->addCollectionNode($domElement, $data);
            } else {
                $this->addSequentialNode($domElement, $data);
            }
        }
    }
}
