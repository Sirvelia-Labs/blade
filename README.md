# Blade

The standalone version of [Laravel's Blade templating engine](https://laravel.com/docs/8.x/blade)
for use outside of Laravel.

## Installation

Install using composer:

```bash
composer require lexdubyna/blade
```

## Usage

Create a Blade instance by passing it the folder(s) where your view files are located, and a cache
folder. Render a template by calling the `make` method. More information about the Blade templating
engine can be found on http://laravel.com/docs/5.8/blade.

```php
use Jenssegers\Blade\Blade;

$blade = new Blade('views', 'cache');

echo $blade->make('homepage', ['name' => 'John Doe'])->render();
```

Alternatively you can use the shorthand method `render`:

```php
echo $blade->render('homepage', ['name' => 'John Doe']);
```

You can also extend Blade using the `directive()` function:

```php
$blade->directive('datetime', function ($expression) {
    return "<?php echo with({$expression})->format('F d, Y g:i a'); ?>";
});
```

Which allows you to use the following in your blade template:

```
Current date: @datetime($date)
```

The Blade instances passes all methods to the internal view factory. So methods such as `exists`,
`file`, `share`, `composer` and `creator` are available as well. Check out the
[original documentation](https://laravel.com/docs/8.x/views) for more information.

## Components

You can make use of [view components](https://laravel.com/docs/8.x/blade#components) with this
package.

To be able to use class-based and anonymous components, you need to register them:

```php
$blade->compiler()->components([
    'alert'                     => App\View\Components\Alert::class, // <x-alert type="success" message="OK" />
    'components.anonymous.link' => 'link'                            // <x-link />
])
```

### Class-based Components

Your class component has to extend `Jenssegers\Blade\ViewComponent` and have a protected property
`$template`:

```php
namespace App\View\Components;

use Jenssegers\Blade\ViewComponent;

class Alert extends ViewComponent
{
    // all the public properties will be exposed inside the template
    public string $type;
    public string $message;

    protected string $template = 'components.alert' // $template is required, it's a path to a blade template file

    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }
}
```

## TODO:

- tests for components
- make compatible with `illuminate/view^9.0`
