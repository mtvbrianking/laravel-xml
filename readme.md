## Laravel XML Support Package

![](./art/banner.png)

[![License](https://poser.pugx.org/bmatovu/laravel-xml/license)](https://packagist.org/packages/bmatovu/laravel-xml)
[![Unit Tests](https://github.com/mtvbrianking/laravel-xml/workflows/run-tests/badge.svg)](https://github.com/mtvbrianking/laravel-xml/actions?query=workflow:run-tests)
[![Code Quality](https://scrutinizer-ci.com/g/mtvbrianking/laravel-xml/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-xml/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mtvbrianking/laravel-xml/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-xml/?branch=master)
[![Documentation](https://github.com/mtvbrianking/laravel-xml/workflows/gen-docs/badge.svg)](https://mtvbrianking.github.io/laravel-xml/master)

This package comes with the much desired xml support for you Laravel project.

**Supports:** Laravel versions v5.3 and above

### Installation

```bash
composer require bmatovu/laravel-xml
```

### Requests

Get the request content (body).

```php
$request->xml();
```

\* Returns `Bmatovu\LaravelXml\Support\XMLElement` object.

Determine if the request content type is XML.

```php
$request->sentXml();
```

Determine if the current request is accepting XML.

```php
$request->wantsXml();
```

Validate XML content

```php
$isValid = Xml::is_valid($request->xml());

if (! $isValid) {
    return response()->xml(['message' => 'The given data was malformed.'], 400);
}
```

**Validation** - Against XML Schema Definition

```php
$errors = Xml::validate($request->xml(), 'path_to/sample.xsd');

if ($errors) {
    return response()->xml([
        'message' => 'The given data was invalid.',
        'errors' => $errors,
    ], 422);
}
```

### Responses


```php
Route::get('/users/{user}', function (Request $request, int $userId) {
    $user = User::findOrFail($userId);

    return response()->xml($user);
});
```

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <id>1</id>
    <name>jdoe</name>
    <email>jdoe@example.com</email>
</document>
```


```php
Route::get('/users/{user}', function (Request $request, int $userId) {
    $user = User::findOrFail($userId);

    return response()->xml(['user' => $user->toArray()]);
});
```

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <user>
        <id>1</id>
        <name>jdoe</name>
        <email>jdoe@example.com</email>
    </user>
</document>
```

```php
Route::get('/users/{user}', function (Request $request, int $userId) {
    $user = User::findOrFail($userId);

    return response()->xml($user, 200, [], ['root' => 'user']);
});
```

```xml
<?xml version="1.0" encoding="UTF-8"?>
<user>
    <id>1</id>
    <name>jdoe</name>
    <email>jdoe@example.com</email>
</user>
```


```php
Route::get('/users', function () {
    $users = User::get();

    return response()->xml(['users' => $users->toArray()]);
});
```

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <users>
        <id>1</id>
        <name>John Doe</name>
        <email>jdoe@example.com</email>
    </users>
    <users>
        <id>2</id>
        <name>Gary Plant</name>
        <email>gplant@example.com</email>
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
Route::post('/users', function (Request, $request) {
    // do something...
})->middleware('xml');
```

This middleware only checks the `Content-Type` by defaul;

[`415` - **Unsupported Media Type**]

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <message>Only accepting content of type XML.</message>
</document>
```

To check is the passed content is valid XML, pass a bool to the middleware

```php
Route::post('/users', function (Request, $request) {
    // do something...
})->middleware('xml:1');
```

[`400` - **Bad Request**]

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <message>The given data was malformed.</message>
</document>
```

### Utilities

**Encode: Array to Xml**

```php
Xml::encode(['key' => 'value']);
```

Or

```php
xml_encode(['key' => 'value']);
```


**Decode: Xml to Array**

```php
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

Reporting bugs
--
If you've stumbled across a bug, please help us by leaving as much information about the bug as possible, e.g.

- Steps to reproduce
- Expected result
- Actual result

This will help us to fix the bug as quickly as possible, and if you do wish to fix it yourself; 
feel free to [fork the package on GitHub](https://github.com/mtvbrianking/laravel-xml) and submit a pull request!
