Dynamic WordPress config
=============

[![Packagist Version](https://img.shields.io/packagist/v/LSVH/dynamic-wp-config.svg?style=flat-square)](https://packagist.org/packages/lsvh/dynamic-wp-config)
[![Packagist Downloads](https://img.shields.io/packagist/dt/LSVH/dynamic-wp-config.svg?style=flat-square)](https://packagist.org/packages/lsvh/dynamic-wp-config)

Dynamically conifugre paths in your WordPress config file.

Installation
------------
Open a terminal in the same folder as your `wp-config.php` file.

```shell
composer require lsvh/dynamic-wp-config
```

Afterwards you should add the following to the top of your `wp-config.php` file.

```php
require 'vendor/autoload.php';
```

Usage
------------

Usually you will do something like...

```php
use \LSVH_Dynamic_WP_Config\Init as Dynamic_Config;

define('WP_HOME', Dynamic_Config::url_with_path());
define('WP_SITEURL', Dynamic_Config::url_with_path());
```

Syntax
------------

```php
url_with_path($install_dir = '')
```

Returns the full URL to the WordPress site.

* string `$install_dir`: Use this parameter to append the installation directory. Necessary if [you installed WordPress in its own directory](https://codex.wordpress.org/Giving_WordPress_Its_Own_Directory) _(Default is `''`)_.


```php
force_protocol($to = 'https')
```

Redirect the WordPress website to a particular HTTP protocol.

* string `$to`: The protocol to redirect to _(Default is `'https'`)_.


```php
force_subdomain($to = 'www.')
```

Redirect the WordPress website to a particular subdomain.

* string `$to`: The subdomain to redirect to _(Default is `'www.'`)_.


```php
avoid_subdomain($from = 'www.')
```

Redirect the WordPress website to the domain without subdomain to avoid the given subdomain.

* string `$from`: The subdomain to avoid _(Default is `'www.'`)_.


```php
force_domain($to)
```

Redirect the WordPress website to a particular domain.

* string `$to`: The domain to redirect to.

License
------------

MIT © [LSVH](https://github.com/LSVH)
