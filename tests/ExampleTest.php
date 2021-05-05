<?php

namespace Bmatovu\LaravelXml\Test;

use Bmatovu\LaravelXml\Http\XmlResponse;
use Bmatovu\LaravelXml\LaravelXml;
use Bmatovu\LaravelXml\Support\XmlElement;
use Illuminate\Http\Request;

/**
 * @internal
 * @coversNothing
 */
final class ExampleTest extends TestCase
{
    /** @see Bmatovu\LaravelXml\LaravelXmlServiceProvider */
    public function testRequestAcceptHeader()
    {
        $request = Request::create('/resources', 'POST');

        $request->headers->add([
            'Accept' => 'application/xml',
        ]);

        static::assertTrue($request->wantsXml());
    }

    public function testRequestContentTypeHeader()
    {
        $request = Request::create('/resources', 'POST');

        $request->headers->add([
            'Content-Type' => 'application/xml',
        ]);

        static::assertTrue($request->isXml());
    }

    public function testRequestGetXmlContentForEmptyBody()
    {
        $request = Request::create('/resources', 'POST');

        static::assertInstanceOf(\SimpleXMLElement::class, $request->xml());
    }

    public function testRequestGetXmlContent()
    {
        $xmlElement = new XmlElement('<document><alias>jdoe</alias></document>');

        $request = Request::create('/resources', 'POST', [], [], [], [], $xmlElement->asXML());

        $request->headers->add([
            'Content-Type' => 'application/xml',
        ]);

        static::assertInstanceOf(\SimpleXMLElement::class, $request->xml());

        static::assertInstanceOf(XmlElement::class, $request->xml());
    }

    public function testRespondsWithXml()
    {
        $request = Request::create('/resources', 'POST');

        $request->headers->add([
            'Accept' => 'application/xml',
        ]);

        $response = $this->app->handle($request);

        static::assertInstanceOf(XmlResponse::class, $response);

        static::assertTrue(false !== mb_strpos($response->headers->get('Content-Type'), 'xml'));
    }

    /** @see Bmatovu\LaravelXml\Support\Facades\LaravelXml */
    public function testEncodeArrayToXml()
    {
        $xmlElement = new XmlElement('<?xml version="1.0" encoding="UTF-8"?><document><alias>jdoe</alias></document>');

        $xmlStr = LaravelXml::encode(['alias' => 'jdoe']);

        static::assertSame($xmlElement->asXML(), $xmlStr);

        // $isValid = LaravelXml::is_valid('');

        // $this->assertFalse($isValid);

        // $isValid = LaravelXml::is_valid('<document><alias>jdoe</alias></document>');

        // $this->assertTrue($isValid);
    }

    public function testDecodeArrayFromXml()
    {
        $arr = LaravelXml::decode('<document><alias>jdoe</alias></document>');

        static::assertSame(['alias' => 'jdoe'], $arr);
    }

    public function testIsValidXmlStr()
    {
        $isValid = LaravelXml::is_valid('');

        static::assertFalse($isValid);

        $isValid = LaravelXml::is_valid('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"><head><title></title></head><body></body></html>');
        static::assertFalse($isValid);

        $isValid = LaravelXml::is_valid('<document><alias>jdoe</alias></document>');

        static::assertTrue($isValid);
    }

    public function testXmlStrIsValidAgainstXsdSchemaThrowsExceptionForMissingXsdSchema()
    {
        $this->expectException(\ErrorException::class);

        LaravelXml::validate('<document></document>', 'unknown.xsd');
    }

    public function testXmlStrIsValidAgainstXsdSchema()
    {
        $errors = LaravelXml::validate('', __DIR__.'/user.xsd');

        static::assertSame(['error' => 'Invalid xml'], $errors);

        $errors = LaravelXml::validate('<document></document>', __DIR__.'/user.xsd');

        static::assertSame([
            'document' => [
                'Missing child element(s). Expected is ( alias ).',
            ],
        ], $errors);

        $errors = LaravelXml::validate('<document><alias>jdoe</alias></document>', __DIR__.'/user.xsd');

        static::assertEmpty($errors);
    }

    /** @see Bmatovu\LaravelXml\Support\XmlElement; */
    public function testXmlElementGetter()
    {
        $user = new XmlElement('<document><alias>jdoe</alias></document>');

        static::assertEquals('jdoe', $user->get('alias'));
        static::assertNull($user->get('email'));
        static::assertFalse($user->get('is_admin', false));
    }
}
