# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Laranex/laravel-myanmar-payments.svg?style=flat-square)](https://packagist.org/packages/Laranex/laravel-myanmar-payments)
[![Total Downloads](https://img.shields.io/packagist/dt/Laranex/laravel-myanmar-payments.svg?style=flat-square)](https://packagist.org/packages/Laranex/laravel-myanmar-payments)

A Laravel Package to deal with Payment Packages from Myanmar. This package can take care of redirect communications.

Supported Payments are as follows.

- Wave Money
- 2C2P

## Installation

You can install the package via composer:

```bash
composer require laranex/laravel-myanmar-payments
```

## Configuration

```bash
  php artisan vendor:publish --tag="laravel-myanmar-payments"
```

[Wave Money Configuration](https://github.com/DigitalMoneyMyanmar/wppg-documentation#23-environment)

## Usage (Wave Money Payment Screen)

```php
use Laranex\LaravelMyanmarPayments\LaravelMyanmarPaymentsFacade;

$paymentScreenUrl = LaravelMyanmarPaymentsFacade::channel('wave_money')->getPaymentScreenUrl($items, $orderId, $amount, $merchantReferenceId, $backendResultUrl);
```
- For more api options for Wave Money, you can read the composition of the function [here](src/WaveMoney.php)

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email naythukhant644@gmail.com instead of using the issue tracker.

## Credits

- [Nay Thu Khant](https://github.com/naythukhant)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
