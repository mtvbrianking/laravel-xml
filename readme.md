## Laravel XML Support Package

[![Total Downloads](https://poser.pugx.org/bmatovu/laravel-xml/downloads)](https://packagist.org/packages/bmatovu/laravel-xml)
[![Latest Stable Version](https://poser.pugx.org/bmatovu/laravel-xml/v/stable)](https://packagist.org/packages/bmatovu/laravel-xml)
[![License](https://poser.pugx.org/bmatovu/laravel-xml/license)](https://packagist.org/packages/bmatovu/laravel-xml)

This package comes with the much desired xml support for you Laravel project including middleware to accept only xml requests, 
http response in xml, and more utilities for xml conversions as well as validation.

**Supports:** Laravel versions 5.3, 5.4, 5.5, 5.6

### Installation

`$ composer require bmatovu/laravel-xml`

**Register Service Provider** 

(Only for Laravel versions 5.3 and 5.4)

In `config/app.php`

```php
'providers' => array(
    // ...
   Bmatovu\LaravelXml\LaravelXmlServiceProvider::class,
),
```

**Register Alias**

In `config/app.php`

```php
'aliases' => [
    // ...
    'Xml' => Bmatovu\LaravelXml\LaravelXml::class,
],
```

If you cached your configurations, you need to run;

`$ php artisan config:cache`

## Usage...

### Requests

Get the XML payload from the request.

```php
$request->xml();
```

Determine if the request is sending XML.

```php
$request->isXml();
```

Determine if the current request is asking for XML in return.

```php
$request->wantsXml();
```

### Responses

```php
Route::get('/user', function () {
    return response()->xml(['user' => 'John Doe']);
});
```

The snippet above will return

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <user>John Doe</user>
</document>
```

With headers having... 

`Content-Type → text/xml; charset=UTF-8`

### Middleware

First register the middleware in `app\Http\Kernel.php`

```php
protected $routeMiddleware = [
    // ...
    'xml' => \Bmatovu\LaravelXml\Http\Middleware\RequireXml::class,
];
```

Then use the middleware on your routes, or in the controllers. 

```php
Route::post('/user/store', function (Request, $request) {
    // do something...
})->middleware('xml');
```

In case of the request is not sending xml, the response will be; [`415` - **Unsupported Media Type**]

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <error>Only accepting xml content</error>
</document>
```

### Utilities

**Encode: Array to Xml**

```php
use Xml;

Xml::encode(['key' => 'value']);
```

Or

```php
xml_encode(['key' => 'value']);
```


**Decode: Xml to Array**

```php
use Xml;

Xml::decode('<?xml version="1.0" encoding="UTF-8"?><document><key>value</key></document>');
```

Or

```php
xml_decode('<?xml version="1.0" encoding="UTF-8"?><document><key>value</key></document>');
```

<hr/>

I Need help!
---
Feel free to [open an issue on Github](https://github.com/mtvbrianking/laravel-xml/issues/new). 
Please be as specific as possible if you want to get help.

Reporting bugs
--
If you've stumbled across a bug, please help us by leaving as much information about the bug as possible, e.g.
- Steps to reproduce
- Expected result
- Actual result

This will help us to fix the bug as quickly as possible, and if you do wish to fix it yourself; 
feel free to [fork the package on GitHub](https://github.com/mtvbrianking/laravel-xml) and submit a pull request!