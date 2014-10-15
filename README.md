# RedBean service provider

RedBean ORM service provider for Silex micro-framework

## Usage

```php
use Neemzy\Silex\Provider\RedBean\ServiceProvider as RedBeanServiceProvider;

$app = new Silex\Application();

$app->register(
    new RedBeanServiceProvider(),
    [
        'redbean.database' => $database,
        'redbean.username' => $username,
        'redbean.password' => $password
    ]
);

// RedBean is now available as an instance in $app['redbean']
$app['redbean']->freeze(true);

$app->run();
```

## About

As of now, this project is mainly a dumb wrapper which aims to make RedBean available as an instance rather than a static class (which can come in handy for testing purposes). All calls to this instance are identically redispatched to the actual RedBean. It also eases access to the app instance within your models (see below). Feel free to contribute to this project if you have any idea to make it better !

## Models

The provider ships with a `Model` class which extends `RedBean_SimpleModel`, which you can inherit from instead of the latter. Doing so makes the provider `box()` every requested bean and bind the app to the resulting model instance. This means two things :

- You are now able to access your Silex app from inside your models' classes, by requesting `$this->app`
- Calling any method that previously returned an instance of `RedBean_OODBBean` now directly returns a proper model instance