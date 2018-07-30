# Base64 Handler (In Progress)

[![Build Status](https://travis-ci.org/normeno/base64-handler.svg?branch=master)][https://travis-ci.org/normeno/base64-handler]
[![Latest Stable Version](https://poser.pugx.org/normeno/base64-handler/v/stable)](https://packagist.org/packages/normeno/base64-handler)
[![Latest Unstable Version](https://poser.pugx.org/normeno/base64-handler/v/unstable)](https://packagist.org/packages/normeno/base64-handler)
[![Total Downloads](https://poser.pugx.org/normeno/base64-handler/downloads)](https://packagist.org/packages/normeno/base64-handler)
[![License](https://poser.pugx.org/normeno/base64-handler/license)](https://packagist.org/packages/normeno/base64-handler)

A simple and powerful package to handle base64.

## Usage

### Init library

```php
$base64Handler = new Base64Handler();
```

### File to Base64

**Path**

```php
$file = 'path/to/file.png';
$convert = $base64Handler->toBase64($file);
```

**URL**

```php
$file = 'http://icons.iconarchive.com/icons/graphicloads/100-flat/256/home-icon.png';
$convert = $base64Handler->toBase64($file);
```

### Base64 to File

```php
$base64 = 'xyz';
$convert = $base64Handler->toFile($base64);
```

## TO-DO

* Check if base64 is a PDF

## License

The _Base64 Handler_ is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Donate

If you find this project useful, you can buy author a glass of juice

* [Buy me a coffee](https://www.buymeacoff.ee/normeno)
