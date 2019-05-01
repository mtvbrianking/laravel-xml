## Laravel XML Support Package

[![Total Downloads](https://poser.pugx.org/bmatovu/laravel-xml/downloads)](https://packagist.org/packages/bmatovu/laravel-xml)
[![Latest Stable Version](https://poser.pugx.org/bmatovu/laravel-xml/v/stable)](https://packagist.org/packages/bmatovu/laravel-xml)
[![License](https://poser.pugx.org/bmatovu/laravel-xml/license)](https://packagist.org/packages/bmatovu/laravel-xml)

This package comes with the much desired xml support for you Laravel project including middleware to accept only xml requests, 
http response in xml, and more utilities for xml conversions as well as validation.

**Supports:** Laravel versions 5.3, 5.4, 5.5, 5.6, 5.7, 5.8

### Installation

`$ composer require bmatovu/laravel-xml`

**Register Service Provider** 

Only for Laravel versions 5.3 and 5.4. For later Laravel versions, this package will be [auto-discovered](https://laravel.com/docs/master/packages#package-discovery).

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

**Validation** - Using XML Schema Definition
```php
use Xml;

$errors = Xml::validate($request->xml(), 'path_to/sample.xsd');

if ($errors)
   return response()->xml(['error' => $errors], 422);
```

### Responses

Expects an array, convent you're objects to arrays prior...

```php
Route::get('/users', function () {
   $users = App\User::all();
   return response()->xml(['users' => $users->toArray()]);
});
```

Sample response from above snippet

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
   <users>
      <id>1</id>
      <name>John Doe</name>
      <email>jdoe@example.com</email>
      <created_at>2018-07-12 17:06:13</created_at>
      <updated_at>2018-07-12 18:00:05</updated_at>
   </users>
   <users>
      <id>2</id>
      <name>Gary Plant</name>
      <email>gplant@example.com</email>
      <created_at>2018-07-12 18:02:26</created_at>
      <updated_at>2018-07-13 11:22:44</updated_at>
   </users>
</document>
```

And will automatically set the content type to xml

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

In case of the request `content-type` is not xml, the response will be; 

[`415` - **Unsupported Media Type**]

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

Credits
---
Under the hood, I'm using;

[Spatie's array to XML convernsion](https://github.com/spatie/array-to-xml)

[Hakre's XML to JSON conversion](https://hakre.wordpress.com/2013/07/09/simplexml-and-json-encode-in-php-part-i)

[Akande's XML validation](https://medium.com/@Sirolad/validating-xml-against-xsd-in-php-5607f725955a)

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