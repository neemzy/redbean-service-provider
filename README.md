# RedBean service provider

RedBean ORM service provider for Silex micro-framework

## Usage

```php
use Neemzy\Silex\Provider\RedBean\ServiceProvider as RedBeanServiceProvider;

$app = new Silex\Application();
$app->register(new RedBeanServiceProvider($connectionString, $username, $password));

// RedBean is now available as an instance in $app['redbean']
$app['redbean']->freeze(true);

$app->run();
```

## About

As of now, this project is a dumb wrapper which aims to make RedBean available as an instance rather than a static class (which can come in handy for testing purposes). All calls to this instance are identically redispatched to the actual RedBean. Feel free to contribute to this project if you have any idea to make it better !