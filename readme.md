## Laravel XML Support Package

[![Total Downloads](https://poser.pugx.org/bmatovu/laravel-xml/downloads)](https://packagist.org/packages/bmatovu/multi-auth)
[![Latest Stable Version](https://poser.pugx.org/bmatovu/laravel-xml/v/stable)](https://packagist.org/packages/bmatovu/multi-auth)
[![License](https://poser.pugx.org/bmatovu/laravel-xml/license)](https://packagist.org/packages/bmatovu/multi-auth)

This package comes with hardy xml support for you Laravel project. It includes middleware to accept only xml requests, http response in xml, and more utilities for xml conversions as well as validation.

**Supports:** Laravel versions 5.3, 5.4, 5.5, 5.6

### Installation

`$ composer require bmatovu/laravel-xml`

**Register Service Provider** 

(Only for Laravel versions 5.3 and 5.4)

In `config/app.php`

```
'providers' => array(
    // ...
   Bmatovu\LaravelXml\LaravelXmlServiceProvider::class,
),
```

**Register Alias**

In `config/app.php`

```
'aliases' => [
    // ...
    'Xml' => Bmatovu\LaravelXml\LaravelXml::class,
],
```

If you cached your configurations, you need to run;

`$ php artisan config:cache`

## Usage...

### Response

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

```$xslt
protected $routeMiddleware = [
    // ...
    'xml' => \Bmatovu\LaravelXml\Http\Middleware\RequireXml::class,
];
```

The add the middleware to your routes, or in the controllers. 

```php
Route::post('/user/store', function (Request, $request) {
    // do something...
})->middleware('xml');
```

In case of the request is not sending xml, the response will be

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <error>Only accepting text/xml</error>
</document>
```

### Utilities

**Encode: Array to Xml**

`Xml::encode(['key' => 'value']);`

Or

`xml_encode(['key' => 'value']);`


**Decode: Xml to Array**
```
Xml::decode('<?xml version="1.0" encoding="UTF-8"?><document><key>value</key></document>');
```

Or

```
xml_decode('<?xml version="1.0" encoding="UTF-8"?><document><key>value</key></document>');
```

<hr/>

I Need help!
---
Feel free to [open an issue on Github](https://github.com/mtvbrianking/laravel-xml/issues/new). Please be as specific as possible if you want to get help.

Reporting bugs
--
If you've stumbled across a bug, please help us by leaving as much information about the bug as possible, e.g.
- Steps to reproduce
- Expected result
- Actual result

This will help me to fix the bug as quickly as possible, and if you'd like to fix it yourself feel free to [fork the package on GitHub](https://github.com/mtvbrianking/laravel-xml) and submit a pull request!