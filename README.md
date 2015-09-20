# Core
A collection of core classes for the coreplex packages.

- [Installation](#installation)
    - [Laravel 5 Integration](#laravel-5-integration)
- [Using the Renderer](#using-the-renderer)
    - [Rendering Templates](#rendering-templates)
- [Using the Session](#using-the-session)
    - [Add Item](#add-item)
    - [Getting Items](#getting-items)
    - [Removing Items](#removing-items)
    

## Installation

This package requires PHP 5.4+, and includes a Laravel 5 Service Provider.

We recommend installing the package through composer. You can either call `composer require coreplex/core` in your 
command line, or add the following to your `composer.json` and then run either `composer install` or `composer update` 
to download the package.

```php
"coreplex/core": "~0.1"
```

### Laravel 5 Integration

To use the package with Laravel 5 firstly add the core service provider to the list of service providers in 
`app/config/app.php`.

```php
'providers' => array(

  Coreplex\Core\CoreServiceProvider::class,

);
```

The publish the config file by running `php artisan vendor:publish`.

## Using the Renderer

To get started with the renderer, firstly you need to initialise the class.

```php
$renderer = new Coreplex\Core\Renderer\Renderer(); 
```

To access the renderer from laravel just access it via the IOC container by its contract or its alias.

```php
public function __construct(Coreplex\Core\Contracts\Renderer $renderer)
{
    $this->renderer = $renderer;
}

$renderer = app('coreplex.core.renderer');
```

### Rendering Templates

To render a view to a string call the `make` method on the renderer. You can also pass dynamic data to the view by 
passing an array of key value pairs as a second parameter.

```php
$view = $renderer->make('path/to/view.php');
$view = $renderer->make('path/to/view.php', ['foo' => 'bar']);
```

## Using the Session

To get started with the session class with firstly need to initialise it.

```php
$config = require('path/to/coreplex.php');

$session = new Coreplex\Core\Session\Native($config);
```

Or with laravel just resolve it from the IOC container.

```php
public function __construct(Coreplex\Core\Contracts\Session $session)
{
    $this->session = $session;
}

$session = app('coreplex.core.session');
```

### Add Item

To add an item to the session use the `put` method.

```php
$session->put('foo', 'bar');
```

Or to flash an value for the next request use the `flash` method.

```php
$session->flash('foo', 'bar');
```

### Getting Items

To get an item from the session use the `get` method.

```php
$session->get('foo');
```

You may also want to check if an item exists in the session; to do so use the `has` method.

```php
$session->has('foo');
```

### Removing Items

To remove an item from the session use the `forget` method.

```php
$session->forget('foo');
```