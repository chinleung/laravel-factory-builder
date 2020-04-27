# Laravel Factory Builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chinleung/laravel-factory-builder.svg?style=flat-square)](https://packagist.org/packages/chinleung/laravel-factory-builder)
[![Quality Score](https://img.shields.io/scrutinizer/g/chinleung/laravel-factory-builder.svg?style=flat-square)](https://scrutinizer-ci.com/g/chinleung/laravel-factory-builder)
[![Total Downloads](https://img.shields.io/packagist/dt/chinleung/laravel-factory-builder.svg?style=flat-square)](https://packagist.org/packages/chinleung/laravel-factory-builder)

A package to allow you to use your factories like an Eloquent builder inspired from [Tighten](https://tighten.co/blog/tidy-up-your-tests-with-class-based-model-factories).

## Installation

You can install the package via composer:

```bash
composer require --dev chinleung/laravel-factory-builder
```

## Configuration

By default, the builder will fetch the models from `App\\` namespace if none has been provided in your builder.

```bash
php artisan vendor:publish --provider="ChinLeung\Factories\FactoriesServiceProvider" --tag="config"
```

## Quick Usage

### Basic

```php
use Tests\Factories\UserFactory;

$user = app(UserFactory::class)->create();
```

### Real-Time Facade

```php
use Facades\Tests\Factories\UserFactory;

$user = UserFactory::create();
```

## Methods

The builder comes with a few methods available for you to use.

### create(int $count = null)

> Create one or more instances of the model.

### make(int $count = null)

> Create one or more instances of the model without saving it in the database.

### created(Model $model): Model

> Hook to alter the model after it has been created. For instance, creating relationships related to the model.

### setProperty(string $property, $value): self

> Set a property for the creation of the model.

### getProperties(): array

> Retrieve the properties used for the model creation.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email hello@chinleung.com instead of using the issue tracker.

## Credits

- [Chin Leung](https://github.com/chinleung)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
